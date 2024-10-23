<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Http\Request;
use App\Services\OrderValidatorService;
use App\Models\OrderData;
use App\Models\State;
use Log;

class PaymentController extends Controller
{
    private $paymentPlatformResolver;
    private $orderController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver, OrderController $orderController)
    {
        // $this->middleware('auth');
        $this->paymentPlatformResolver = $paymentPlatformResolver;
        $this->orderController = $orderController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay(Request $request)
    {
        $validPaymentCaseData = $request->validate([
            'is_bank_transfer' => 'required|boolean',
        ]);

        $orderCreationResult = $this->orderController->store($request);
        $orderId = NULL;
        if ($orderCreationResult["status"] == 500) {
            return response()->json(
                $orderCreationResult,
                500
            );
        } elseif ($validPaymentCaseData['is_bank_transfer']) {
            return response()->json($orderCreationResult, $orderCreationResult["status"]);
        } else {
            $orderId = $orderCreationResult["data"]["order_id"];
        }

        $orderValidatorService = new OrderValidatorService($validPaymentCaseData['is_bank_transfer']);
        $validRequestParameterList = $orderValidatorService->validate($request);
        $validPaymentData = $validRequestParameterList['VALID_PAYMENT']['payment'];

        $paymentPlatformService = $this->paymentPlatformResolver->resolveService($validPaymentData['payment_platform']);
        $resultArray = $paymentPlatformService->handlePayment($request, $validPaymentData);
        /*
         * For Stripe we avoid to send a client a private information (clientKey, payment_method and etc) so that
         * we do ALL processing on the server and if it is necessary we send back a client data for the additional approvement via
         * Stripe 3D Secure (in that case a client doesn't need to communicate with the server, he sends back a request to Stripe directly via Javascript on the component - see stripe\Stripe3DSecureComp).
        */
        if ($validPaymentData['payment_platform'] === 2) // Stripe
        {
            $request->request->add(['payment_method_id' => $resultArray['data']['paymentMethodId']]);
            $approvalResultArray = $paymentPlatformService->handleApproval($request);
            $this->postApproval($approvalResultArray, $orderId);
            return response()->json($approvalResultArray, 200);
        } else {
            $resultArray["data"]['order_id'] = $orderId;
            $resultArray["data"]['payment_platform_id'] = $validPaymentData['payment_platform'];
            return response()->json($resultArray, 200);
        }
    }

    public function approve(Request $request)
    {
        $validRequestParameterData = $request->validate([
            'order_id' => ['required'], ['exists:order_data,id'],
            'payment_platform' => ['required'], ['exists:payment_platforms,id'],
        ]);
        $paymentPlatform = $validRequestParameterData['payment_platform'];
        $orderId = $validRequestParameterData['order_id'];
        $paymentPlatformService = $this->paymentPlatformResolver->resolveService($paymentPlatform);
        $approvalResultArray = $paymentPlatformService->handleApproval($request);
        $this->postApproval($approvalResultArray, $orderId);

        return response()->json(
            $approvalResultArray,
            $approvalResultArray["status"]
        );
    }

    public function cancell(Request $request)
    {
        // In case of cancellation
        $validRequestParameterData = $request->validate([
            'params' => 'required|array',
            'params.order_id' => ['required'], ['exists:order_data,id'],
        ]);
        return response()->json(
            $this->orderController->destroy($validRequestParameterData['params']['order_id']),
            200
        );
    }

    private function postApproval(&$approvalResultArray, $orderId)
    {
        // Bad status
        if ($approvalResultArray["status"] === 500) {
            // delete order
            $this->orderController->destroy($orderId);
        } else {
            $orderData = OrderData::findOrFail($orderId);
            
            $payedStatus = State::orderPayedStatus();
            $orderData->state()->associate($payedStatus);
            $orderData->save();

            $approvalResultArray['data']['order_number'] = $orderData->order_uuid;
            $approvalResultArray['data']['order_id'] = $orderId;
        }
    }
}

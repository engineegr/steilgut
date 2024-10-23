<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\OrderValidatorService;
use App\Models\Product;
use App\Models\OrderData;
use App\Models\Address;
use App\Models\Person;
use App\Models\PersonalData;
use App\Models\Phone;
use App\Models\State;
use App\Models\DeliveryOption;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderValidatorService = new OrderValidatorService($request->input('is_bank_transfer'));
        $validRequestParameterList = $orderValidatorService->validate($request);
        $validDeliveryOptionList = $validRequestParameterList['VALID_DELIVERY_OPTIONS']['delivery_options'];
        $validCart = $validRequestParameterList['VALID_CART']['cart'];
        $validPersonalData = $validRequestParameterList['VALID_PERSONAL_DATA']['personal_data'];
        $validAddressData = $validRequestParameterList['VALID_ADDRESS']['address'];
        $validPrices = $validRequestParameterList['VALID_PRICES']['prices'];
        $orderNumber = NULL;
        $orderId = NULL;

        try {
            DB::beginTransaction();
            // try to find our Person
            $foundPersonList = Person::where('email', $validPersonalData['email'])->get();
            $p = NULL;

            if ($foundPersonList->count() > 1) {
                return response()->json([
                    "errors" => [
                        "500" => __(
                            'order.failedOrderCreation',
                            [
                                'error_msg' => __('order.tooManyPersonErrorMsg'),
                                'error_code' => 500
                            ]
                        )
                    ],
                    "status" => 500,
                ], 500);
            }
            if ($foundPersonList->count() == 0) {
                // create a Person with PersonData
                $ph = Phone::make([
                    'phone_number' => $validPersonalData['phone']
                ]);
                $p = Person::create([
                    'email' => $validPersonalData['email'],
                ]);
                $p->phones()->save($ph);

                // couldn't save personal data without Person: PersonalData is a child of Person
                $pd = PersonalData::make([
                    'lfp' => $validPersonalData['lfp'],
                ]);
                $p->personalData()->save($pd);
            } else {
                $p = $foundPersonList->first();
            }

            $foundAddressList = NULL;
            $deliveryAddress = NULL;
            $selectedDeliveryOption = NULL;

            // delivery from winery
            if ($validDeliveryOptionList[0]) {
                $foundAddressList = Address::where('country', $validAddressData['country'])
                    ->whereNull('google_place_id')->whereNull('full_path')
                    ->whereNull('county')->whereNull('city')
                    ->whereNull('street')->whereNull('building_number')
                    ->whereNull('zip_code')->whereNull('flat_number')
                    ->whereNull('organization_title')
                    ->get();

                if ($foundAddressList->count() != 0) {
                    $deliveryAddress = $foundAddressList->first();
                } else {
                    $deliveryAddress = Address::create(
                        [
                            'country' => $validAddressData['country'],
                        ]
                    );
                }

                $selectedDeliveryOption = DeliveryOption::selfDeliveryOption();

                // post delivery
            } else {
                $toSaveDeliveryAddress = true;
                $isGooglePlaceId = array_key_exists('google_place_id', $validAddressData);
                $isAddressFullPath = array_key_exists('full_path', $validAddressData);

                if ($isGooglePlaceId || $isAddressFullPath) {
                    if ($isGooglePlaceId) {
                        $foundAddressList = Address::where('google_place_id', $validAddressData['google_place_id'])->get();
                    }
                    if (!$foundAddressList || ($foundAddressList->count() == 0 && $isAddressFullPath)) {
                        $foundAddressList = Address::where('full_path', $validAddressData['full_path'])->get();
                    }

                    if ($foundAddressList->count() != 0) {
                        $deliveryAddress = $foundAddressList->first();
                        $toSaveDeliveryAddress = false;
                    }
                }
                if ($toSaveDeliveryAddress) {
                    if ($isGooglePlaceId) {
                        $deliveryAddress = Address::create(
                            [
                                'country' => $validAddressData['country'],
                                'google_place_id' => $validAddressData['google_place_id'],
                                'full_path' => $validAddressData['full_path'],
                                'zip_code' => $validAddressData['zip_code'],
                                'county' => $validAddressData['county'],
                                'city' => $validAddressData['city'],
                                'street' => $validAddressData['street'],
                                'building_number' => $validAddressData['building_number'],
                                'organization_title' => $validAddressData['organization_title'],
                            ]
                        );
                    } else {
                        $deliveryAddress = Address::create(
                            [
                                'country' => $validAddressData['country'],
                                'full_path' => $validAddressData['full_path'],
                                'zip_code' => $validAddressData['zip_code'],
                            ]
                        );
                    }
                }

                if ($validDeliveryOptionList[0]) {
                    $selectedDeliveryOption = DeliveryOption::selfDeliveryOption();
                } else if ($validDeliveryOptionList[1]) {
                    $selectedDeliveryOption = DeliveryOption::courierDeliveryOption();
                } else if ($validDeliveryOptionList[2]) {
                    $selectedDeliveryOption = DeliveryOption::postDeliveryOption();
                } else {
                    throw new \InvalidArgumentException("Error [OrderController::store] Unknown delivery option parameter");
                }
            }
            // Create our order data and bind it with the person and status
            $orderData = OrderData::make();
            $openStatus = State::orderOpenStatus();
            $orderData->state()->associate($openStatus); // don't save for awhile (Order data has constraint on Person and State tables) otherwise it falls with Exception
            // Connect our order to the delivery address
            $orderData->address()->associate($deliveryAddress);
            $orderData->deliveryOption()->associate($selectedDeliveryOption);
            $uuid = (string)Str::orderedUuid();
            $orderData->order_uuid = $uuid;
            $orderData->subtotal_price = $validPrices['subtotal_price'];
            $orderData->delivery_price = $validPrices['delivery_price'];
            // Save our orderData and connect it to our Person
            $p->orderData()->save($orderData);

            foreach ($validCart as $i => $cartProduct) {
                $aProduct = Product::find($cartProduct['id']);
                $subtotal = $cartProduct['subtotal'];
                if ($aProduct->total_in_stock < $subtotal) {
                    throw new \PDOException("Error [OrderController::store] Couldn't save the order: subtotal of a cart product is more than the product quantity in the stock. [Product id] : [ " . $aProduct->id . " ] [ Total on the stock ] : [ " . $aProduct->total_in_stock . " ] [ Subtotal in the cart ] : [ " . $cartProduct['subtotal'] . " ]");
                }
                $aProduct->total_in_stock = $aProduct->total_in_stock - $subtotal;
                $aProduct->orders()->attach($orderData->id, ['subtotal' => $subtotal]);
                $aProduct->save();
            }
            DB::commit();
            $orderId = $orderData->id;
            $orderData = OrderData::findOrFail($orderId);
            // $orderNumber = $orderData->order_uuid . "-" . $orderId;
            $orderNumber = $orderId;
        } catch (\PDOException $ex) {
            DB::rollback();
            return [
                "errors" => [
                    "500" => __(
                        'order.failedOrderCreation',
                        [
                            'error_msg' => $ex->getMessage(),
                            'error_code' => $ex->getCode()
                        ]
                    ),
                ]
            ];
        }
        return [
            'data' => [
                "order_id" => $orderId,
                'order_number' => $orderNumber,
            ],
            "status" => 200,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validParamData = $request->validate([
            'params' => 'required|array',
            'params.is_order_change_status' => 'boolean',
        ]);

        $newState = NULL;

        if ($validParamData['params']['is_order_change_status']) {
            $validParamData = $request->validate([
                'params.order_state_id' => 'required|exists:states,id',
            ]);

            $orderData = OrderData::findOrFail($id);
            $orderData->state()->disassociate($orderData->state);
            $newState = State::findOrFail($validParamData['params']['order_state_id']);
            $orderData->state()->associate($newState);
            $orderData->save();

            return response()->json([
                "data" => [
                    "withSuccess" => "Order with id [ $id ] changed status to [ $newState->status ]",
                ],
                "status" => 200,
            ], 200);
        }

        return response()->json([
            "errors" => [
                "400" => "Error [OrderController::update] 400 - Bad request: Unknown request parameters",
            ]
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $orderData = OrderData::findOrFail($id);
            foreach ($orderData->products as $product) {
                $product->total_in_stock += $orderData->subtotal;
                $product->orders()->detach($orderData->id);
                $product->save();
            }

            $toDropPerson = true;
            $person = $orderData->person;
            foreach ($person->orderData as $personOrderData) {
                if ($personOrderData->id !== $id) {
                    $toDropPerson = false;
                }
            }

            if ($toDropPerson) {
                $orderData->person()->disassociate($orderData->id);
                $person->delete();
            }

            $address = $orderData->address;
            if (!$address->isCountryOnly()) {
                $toDropAddress = true;
                foreach ($address->$orderData as $addressOrderData) {
                    if ($addressOrderData->id !== $id) {
                        $toDropAddress = false;
                    }
                }

                if ($toDropAddress) {
                    $orderData->address()->disassociate($orderData->id);
                    $address->delete();
                }
            }

            $orderData->delete();
            DB::commit();
        } catch (\PDOException $ex) {
            DB::rollback();
            abort(500, "Order with id ${id} couldn't be deleted");
        }
        return [
            "data" => [
                "withSuccess" => "Order with id ${id} was successfuly deleted",
            ]
        ];
    }
}

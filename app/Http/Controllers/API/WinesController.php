<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wine;
use App\Http\Resources\WinesShowResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\TitleWinesRangeController;

class WinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        TitleWinesRangeController $titleWinesRangeController
    ) {
        Validator::make($request->all(), [
            'is_title_map' => 'string',
        ])->validate();

        $isTitleMap = boolval($request->input('is_title_map'));
        if ($isTitleMap) {
            $titleList = Wine::titleList();
            $titleCountMap = array();
            $titleMap = array();
            foreach ($titleList as $title) {
                $titleCountMap[$title] = Wine::titleWineCount($title);
                $titleMap[$title] = $titleWinesRangeController->__invoke(0, 1, $title, $request);
            }

            return response()->json([
                'data' => [
                    'titleMap' => $titleMap,
                    'titleCountMap' => $titleCountMap,
                ],
            ], 200);
        }

        return response()->json([
            "errors" => [
                "400" => "Error [WinesController::index] 400 - Bad request: Unknown request parameters",
            ]
        ], 400);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new WinesShowResource(Wine::findOrFailWithBackgroundImage($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Return a value list of wine attributes (color, harvest, sort, type and etc) 
     */
    public function getAttributeList(Request $request, $attribute)
    {
        switch ($attribute) {
            case 'colors':
                return Wine::colorList();
                break;

            case 'sorts':
                return Wine::sortList();
                break;

            case 'harvests':
                return Wine::harvestList();
                break;

            case 'types':
                return Wine::typeList();
                break;

            case 'volumes':
                return Wine::bottleVolumeList();
                break;

            default:
                throw new InvalidArgumentException('WineController::getAttributeList Unknow Wine attribute name');
                break;
        }
    }
}

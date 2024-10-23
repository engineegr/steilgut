<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wine;
use App\Models\BackgroundImage;
use App\Models\Category;
use App\Models\UserRole;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\WinesIndexResource;
use App\Http\Resources\WinesShowResource;

class WinesCatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.admin.dashboard')->with(
            [
                'categories' => CategoryResource::collection(Category::categoryDictItems()),
                'activeCategory' => new CategoryResource(Category::wineCategoryDictItem()),
                'winesBranch' => 'CATALOG',
                'items' => WinesIndexResource::collection(Wine::paginate(3)),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0]) || request()->user()->hasRole(UserRole::$USER_ROLE_DICT[1])) {
            return view('cms.admin.wines.wines-catalog-update-form')->with(
                [
                    'categoryTitle' => 'CATALOG',
                    'item' => new WinesShowResource(Wine::findOrFail($id)),
                    'isReadOnly' => true
                ]
            );
        } else {
            return view('app');
        }
    }

    public function edit($id, Request $request)
    {
        $wineItem = Wine::findOrFail($id);
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            return view('cms.admin.wines.wines-catalog-update-form')->with(
                [
                    'categoryTitle' => 'CATALOG',
                    'item' => Wine::findOrFail($id),
                    'isReadOnly' => false
                ]
            );
        } else {
            return view('app');
        }
    }

    public function update($id, Request $request)
    {
        if ($request->method() === "GET") {
            return view('cms.admin.wines.wines-catalog-update-form')->with(
                [
                    'categoryTitle' => 'CATALOG',
                    'item' => Wine::findOrFail($id),
                    'isReadOnly' => false
                ]
            );
        }
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            $validData = $this->__extractValidData($request);

            $wineItem = Wine::findOrFail($id);
            $itemStength = $validData['strength--mobile'] != $wineItem->strength 
                ? $validData['strength--mobile'] : $validData['strength'];
            
            
            $updateWine = $wineItem->fill([
                'title' => $validData['title'],
                'wineType' => $validData['wineType'],
                'price' => str_replace(',', '.', $validData['price']),
                'residual_sugar' => $validData['sugar'],
                'acidity' => $validData['acidity'],
                'strength' => $itemStength,
            ]);

            $this->updateLocalizedFields($validData, $updateWine);

            $updateProduct = $updateWine->product->fill([
                'total_in_stock' => $validData['count'],
                'discount' => ($validData['discount'] / 100),
            ]);

            $updateWine->save();
            $updateProduct->save();
            return view('cms.admin.wines.wines-catalog-update-form')->with(
                [
                    'categoryTitle' => 'CATALOG',
                    'item' => Wine::findOrFail($updateWine->id),
                    'isReadOnly' => false,
                    'messages' => [
                        'Wine item was successfully stored'
                    ]
                ]
            );
        } else {
            return view('app');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('INFO [WinesController::destroy]');
    }

    private static function __extractValidData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:96',
            'wineType' => 'required|string|max:96',
            'sort' => 'string|max:96',
            'sort--mobile' => 'string|max:96',
            'soil' => 'required|string|max:96',
            'terroir' => 'required|string|max:96',
            'harvestAspect' => 'required|string|max:4096',
            'taste' => 'required|string|max:4096',
            'count' => 'required|digits_between:0,10000',
            'price' => ['required', 'regex:/^(\d+(,\d{1,7})?)$/'],
            'discount' => ['required', 'digits_between:0,100'],
            'sugar' => ['required', 'numeric', 'regex:/^(\d+(\.\d{1,7})?)$/'],
            'acidity' => ['required', 'numeric', 'regex:/^(\d+(\.\d{1,7})?)$/'],
            'strength' => ['numeric', 'regex:/^(\d+(\.\d{1,7})?)$/'],
            'strength--mobile' => ['numeric', 'regex:/^(\d+(\.\d{1,7})?)$/'],
            'langInputField' => 'required|string|exists:languages,lang'
        ]);
    }


    public static function updateLocalizedFields(array $validData, Wine &$wineItem)
    {
        $itemWineSort = $validData['sort--mobile'] != $wineItem->wineSort 
            ? $validData['sort--mobile'] : $validData['sort'];

        $selectedLang = $validData['langInputField'];
        $wineItem->title = [
            $selectedLang => $validData['title'],
        ];
        $wineItem->wineType = [
            $selectedLang => $validData['wineType'],
        ];
        $wineItem->wineSort = [
            $selectedLang => $itemWineSort,
        ];
        $wineItem->soil = [
            $selectedLang => $validData['soil'],
        ];
        $wineItem->terroir = [
            $selectedLang => $validData['terroir'],
        ];
        $wineItem->harvest_aspect = [
            $selectedLang => $validData['harvestAspect'],
        ];
        $wineItem->taste = [
            $selectedLang => $validData['taste'],
        ];
    }
}

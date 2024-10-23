<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wine;
use App\Models\Category;
use App\Models\UserRole;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\WineHeadersIndexResource;
use App\Http\Resources\WinesIndexResource;
use Illuminate\Support\Facades\File;
use App\Utilities\ImageHelper;

class WinesSliderController extends Controller
{
    const IMAGE_HELPER_NAMESPACE_PATH = 'App\Utilities\ImageHelper::';
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
                'winesBranch' => 'SLIDER',
                'items' => WineHeadersIndexResource::collection(Wine::headerList()->paginate(3)),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sample = Wine::findOrFail(1);
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            return view('cms.admin.wines.wines-slider-modify-form')->with(
                [
                    'categoryTitle' => 'WINES',
                    'winesBranch' => 'SLIDER',
                    'isReadOnly' => false,
                    'add' => 0,
                    'item' => $sample
                ]
            );
        } else {
            return view('app');
        }
    }

    public function add($id)
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            $sample = Wine::findOrFail($id);
            return view('cms.admin.wines.wines-slider-modify-form')->with(
                [
                    'categoryTitle' => 'WINES',
                    'winesBranch' => 'SLIDER',
                    'isReadOnly' => false,
                    'add' => 1,
                    'item' => $sample
                ]
            );
        } else {
            return view('app');
        }
    }

    /**
     * Store a newly created wine into the slider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $add, $id)
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            if ($add) {
                $origWine = Wine::findOrFail($id);
                $validData = array_merge($this->__extractValidDataToAdd($request), $this->__extractValidDataToCreateToAdd($request));
                $count = Wine::wineCountByTitleAndHarvest($validData['title'], $validData['harvest']);
                if ($count > 0) {
                    return back()->withErrors([
                        'message' => 'A wine with the title [' . $validData['title'] . '] already exists'
                    ]);
                }
                $newWine = $this->__saveWineToAdd($validData, $origWine);
            } else {
                $validData = array_merge($this->__extractValidDataToCreate($request), $this->__extractValidDataToCreateToCreate($request));
                $count = Wine::wineCountByTitle($validData['title']);
                if ($count > 0) {
                    return back()->withErrors([
                        'message' => 'A wine with the title [' . $validData['title'] . '] already exists'
                    ]);
                }
                $newWine = $this->__saveWineToCreate($validData);
            }
            if($add) {
                // admin.dashboard.wines-slider.show
                return redirect()->route(
                    'admin.dashboard.wines-slider.show',
                    [
    
                        'id' => $newWine->id,
                        'title' => $newWine->title
                    ]
                )->with([
                    'categoryTitle' => 'SLIDER',
                    'isReadOnly' => false,
                    'messages' => [
                        'A wine [ ' . $newWine->title . ' ] was successfully created'
                    ]
                ]);
            }

            return redirect()->route(
                'admin.dashboard.wines-slider'
            )->with([
                'categoryTitle' => 'SLIDER',
                'isReadOnly' => false,
                'messages' => [
                    'A wine [ ' . $newWine->title . ' ] was successfully created'
                ]
            ]);
        } else {
            return back()->withErrors([
                'message' => 'User has no sufficient permissions'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $title)
    {
        return view('cms.admin.dashboard')->with(
            [
                'categories' => CategoryResource::collection(Category::categoryDictItems()),
                'activeCategory' => new CategoryResource(Category::wineCategoryDictItem()),
                'winesBranch' => 'CATALOG',
                'items' => WinesIndexResource::collection(Wine::titleWineList($title)->paginate(3)),
            ]
        );
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

    private function __saveWineToCreate($validData)
    {
        $this->__saveBackgroundImage16_9($validData);
        $this->__saveBackgroundImage4_3($validData);
        $wineBottlePicturePath = $this->__saveWineBottlePicture($validData);
        $itemStength = $validData['strength--mobile'] != $validData['strength']
            ? $validData['strength--mobile'] : $validData['strength'];

        $last = Wine::getLastByOrder();
        $newWine = Wine::make([
            'title' => $validData['title'],
            'harvest' => $validData['harvest'],
            'wineType' => $validData['wineType'],
            'price' => str_replace(',', '.', $validData['price']),
            'residual_sugar' => $validData['sugar'],
            'acidity' => $validData['acidity'],
            'strength' => $itemStength,
            'image' => $wineBottlePicturePath,
            'order' => ($last->order + 1)
        ]);

        WinesCatalogController::updateLocalizedFields($validData, $newWine);
        $newWine->save();

        $newWineBackroundImage = $newWine->backgroundImage()->make();
        $newWineBackroundImage->relative_path = 'single-wine-pg/' . $validData['title'] . '-single-wine-pg';
        $newWineBackroundImage->base_name = 'bg-' . $validData['title'] . '-single-wine-pg';

        $newWineProduct = $newWine->product()->make([
            'total_in_stock' => $validData['count'],
            'discount' => ($validData['discount'] / 100),
        ]);

        $newWineBackroundImage->save();
        $newWineProduct->save();

        return $newWine;
    }

    private function __saveWineToAdd($validData, $origWine)
    {
        $last = Wine::getLastByOrder();
        $itemStrength = $validData['strength'] != $origWine->strength ? $validData['strength']
            : ($validData['strength--mobile'] != $origWine->strength 
            ? $validData['strength--mobile'] : $origWine->strength);

        $newWine = Wine::make([
            'title' => $validData['title'],
            'harvest' => $validData['harvest'],
            'wineType' => $validData['wineType'],
            'price' => str_replace(',', '.', $validData['price']),
            'residual_sugar' => $validData['sugar'],
            'acidity' => $validData['acidity'],
            'strength' => $itemStrength,
            'image' => $origWine->image,
            'order' => ($last->order + 1)
        ]);

        WinesCatalogController::updateLocalizedFields($validData, $newWine);
        $newWine->save();

        $newWineBackroundImage = $newWine->backgroundImage()->make();
        $newWineBackroundImage->relative_path = $origWine->backgroundImage->relative_path;
        $newWineBackroundImage->base_name = $origWine->backgroundImage->base_name;

        $newWineProduct = $newWine->product()->make([
            'total_in_stock' => $validData['count'],
            'discount' => ($validData['discount'] / 100),
        ]);

        $newWineBackroundImage->save();
        $newWineProduct->save();

        return $newWine;
    }

    private static function __extractValidDataToCreateToCreate(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:96',
            'harvest' => ['required', 'integer', 'between:1800,2024']
        ]);
    }

    private static function __extractValidDataToCreateToAdd(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:96',
            'harvest' => ['required', 'integer', 'between:1800,2024']
        ]);
    }

    private static function __extractValidDataToCreate(Request $request)
    {
        return $request->validate([
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
            'langInputField' => 'required|string|exists:languages,lang',
            'wineBackgroundPicture_16_9' => 'image|max:20256|required|mimes:jpeg,jpg',
            'wineBackgroundPicture_4_3' => 'image|max:20256|required|mimes:jpeg,jpg',
            'wineBottlePicture' => 'image|max:10128|required|mimes:png'
        ]);
    }

    private static function __extractValidDataToAdd(Request $request)
    {
        return $request->validate([
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

    private static function __saveBackgroundImage16_9($requestData)
    {
        $image = $requestData['wineBackgroundPicture_16_9'];
        $wineTitle = $requestData['title'];
        $origImagePath = $image->store('/images/cms/wines-page/16_9');
        self::__storeBackgroundImageList_16_9($wineTitle, $origImagePath);
    }

    private static function __saveBackgroundImage4_3($requestData)
    {
        $image = $requestData['wineBackgroundPicture_4_3'];
        $wineTitle = $requestData['title'];
        $origImagePath = $image->store('/images/cms/wines-page/4_3');
        self::__storeBackgroundImageList_4_3($wineTitle, $origImagePath);
    }

    /**
     * Wine bottle picture should be W * H = 230 * 1100
     */
    private static function __saveWineBottlePicture($requestData)
    {
        $image = $requestData['wineBottlePicture'];
        $wineTitle = $requestData['title'] . '.png';
        $origImagePath = $image->store('/images/cms/wines-page');
        $rootDir = ImageHelper::$PUBLIC_IMG_PATH . '/pictures/wine-bottles';
        ImageHelper::resizeAndStorePicture($origImagePath, $rootDir, $wineTitle);

        return '/images/pictures/wine-bottles/' . $wineTitle;
    }

    private static function __storeBackgroundImageList_16_9($wineTitle, $origImagePath)
    {
        $dirStructure = array(
            'single-wine-pg/' . $wineTitle . '-single-wine-pg/fhd_1920*1080/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToFHD_16_9',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/hd_1280*720/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToHD_16_9',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/hdplus_1600*900/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToHDPlus_16_9',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/wxga_1366*768/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToWXGA_16_9',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/lg_1024*576/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToLG_16_9',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/md_764*432/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToMD_16_9',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/sm_640*360/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToSM_16_9',
        );

        foreach ($dirStructure as $dir => $callBackFunc) {
            $rootDir = ImageHelper::$PUBLIC_IMG_16_9_PATH . '/' . $dir;
            if (!File::isDirectory($rootDir)) {
                File::makeDirectory($rootDir, 0755, true, true);
            }
            call_user_func_array(
                $callBackFunc,
                array($origImagePath, $rootDir, $wineTitle . '-single-wine-pg.jpg')
            );
        }
    }

    private static function __storeBackgroundImageList_4_3($wineTitle, $origImagePath)
    {
        $dirStructure = array(
            'single-wine-pg/' . $wineTitle . '-single-wine-pg/xl_1440*1024/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToXL_4_3',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/lg_1024*768/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToLG_4_3',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/md_768*546/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToMD_4_3',

            'single-wine-pg/' . $wineTitle . '-single-wine-pg/wxga_640*455/jpg'
            => self::IMAGE_HELPER_NAMESPACE_PATH . 'resizeAndStoreImageToSM_4_3'
        );

        foreach ($dirStructure as $dir => $callBackFunc) {
            $rootDir = ImageHelper::$PUBLIC_IMG_4_3_PATH . '/' . $dir;
            if (!File::isDirectory($rootDir)) {
                File::makeDirectory($rootDir, 0755, true, true);
            }
            call_user_func_array(
                $callBackFunc,
                array($origImagePath, $rootDir, $wineTitle . '-single-wine-pg.jpg')
            );
        }
    }
}

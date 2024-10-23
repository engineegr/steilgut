<?php

use Illuminate\Support\Facades\Route;
use App\Models\OrderData;
use Illuminate\Http\Request;
use App\Models\Wine;
use App\Http\Controllers\API\HarvestWinesRangeController;
use App\Http\Controllers\API\TitleWinesRangeController;
use App\Http\Controllers\API\WineHeadersRangeController;
use \Illuminate\Support\Facades\Storage;
use \App\Http\Controllers\API\OrderNotificationController;

use App\Models\Category;
use App\Http\Resources\CategoryResource;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 
 * Change a locale code from LangSwitchComp: please, see locale codes for Laravel: 
 * @link https://laravel-lang.github.io/lang/referents.html
 */

Route::post('/locale/update', function (Request $request) {
    $validateLocale = $request->validate([
        'locale' => 'required|string',
    ]);

    $locale = $validateLocale['locale'];
    $locale = $locale === 'cn' ? 'zh_CN' : $locale;
    if (!App::isLocale($locale)) {
        Session::put('STEILGUT_LOCALE', $locale);
    }
    return redirect()->back();
});


/*
 * Download link for a legal document (see WiderrufComp.vue)
 */
Route::get('/legal/widerruf-muster', function (Request $request) {
    return Storage::download('Widerruf-Muster.pdf');
});

// CMS
Auth::routes();

Route::get('/cms/admin', [App\Http\Controllers\AdministratorController::class, 'index'])->name('admin.dashboard');

// CMS: NEWS
Route::get('/cms/admin/news', [App\Http\Controllers\NewsController::class, 'index'])->name('admin.dashboard.news');
Route::post('/cms/admin/news/{id}/destroy', [App\Http\Controllers\NewsController::class, 'destroy'])
    ->name('admin.dashboard.news.destroy');

Route::get('/cms/admin/news/{id}/show', [App\Http\Controllers\NewsController::class, 'show'])
    ->name('admin.dashboard.news.show');

Route::get('/cms/admin/news/create', [App\Http\Controllers\NewsController::class, 'create'])
    ->name('admin.dashboard.news.create');
Route::post('/cms/admin/news/store', [App\Http\Controllers\NewsController::class, 'store'])
    ->name('admin.dashboard.news.store');

Route::get('/cms/admin/news/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])
    ->name('admin.dashboard.news.edit');
Route::post('/cms/admin/news/{id}/update', [App\Http\Controllers\NewsController::class, 'update'])
    ->name('admin.dashboard.news.update');

// CMS: WINES
Route::get('/cms/admin/wines', function (Request $request) {
    return view('cms.admin.dashboard')->with(
        [
            'categories' => CategoryResource::collection(Category::categoryDictItems()),
            'activeCategory' => new CategoryResource(Category::wineCategoryDictItem()),
        ]
    );
});

// WINES CATALOG
Route::get('/cms/admin/wines-catalog', [App\Http\Controllers\WinesCatalogController::class, 'index'])->name('admin.dashboard.wines-catalog');

Route::post('/cms/admin/wines-catalog/{id}/destroy', [App\Http\Controllers\WinesCatalogController::class, 'destroy'])
    ->name('admin.dashboard.wines-catalog.destroy');

Route::get('/cms/admin/wines-catalog/{id}/edit', [App\Http\Controllers\WinesCatalogController::class, 'edit'])
    ->name('admin.dashboard.wines-catalog.edit');

Route::get('/cms/admin/wines-catalog/{id}/show', [App\Http\Controllers\WinesCatalogController::class, 'show'])
    ->name('admin.dashboard.wines-catalog.show');

Route::match(['post', 'get'], '/cms/admin/wines-catalog/{id}/update', [App\Http\Controllers\WinesCatalogController::class, 'update'])
    ->name('admin.dashboard.wines-catalog.update');

// WINES SLIDER
Route::get('/cms/admin/wines-slider', [App\Http\Controllers\WinesSliderController::class, 'index'])->name('admin.dashboard.wines-slider');

Route::get('/cms/admin/wines-slider/{id}/edit', [App\Http\Controllers\WinesSliderController::class, 'edit'])->name('admin.dashboard.wines-slider.edit');

Route::get('/cms/admin/wines-slider/{id}/{title}/show', [App\Http\Controllers\WinesSliderController::class, 'show'])->name('admin.dashboard.wines-slider.show');

Route::get('/cms/admn/wines-slider/create', [App\Http\Controllers\WinesSliderController::class, 'create'])->name('admin.dashboard.wines-slider.create');
Route::get('/cms/admn/wines-slider/add/{id}', [App\Http\Controllers\WinesSliderController::class, 'add'])->name('admin.dashboard.wines-slider.add');

Route::post('/cms/admn/wines-slider/store/{add}/{id}', [App\Http\Controllers\WinesSliderController::class, 'store'])->name('admin.dashboard.wines-slider.store');

// END of CMS ROUTE. Default: redirect to start page
Route::get('/cms', function (Request $request) {
    return redirect()->route('admin.dashboard');
});

// Route::get('/demo', function (Request $request) {
//     return view('demo');
// });

Route::get('/order/test/sendNotification/{id}', function (Request $request, OrderNotificationController $orderNotificationController, $id) {
    $orderNotificationController->__invoke($request, $id);
    $order = OrderData::findOrFail($id);
    return view('email.wine-order')->with([
        'orderData' => $order,
    ]);
})->name('sendTestOrderNotification');

Route::get('/{any?}', function (
    Request $request,
    TitleWinesRangeController $titleWinesRangeController
) {

    // Create an initial state
    // For Wines Page
    $titleList = Wine::titleList();
    $titleCountMap = array();
    $titleMap = array();
    foreach ($titleList as $title) {
        $wineTitleCount = Wine::titleWineCount($title);
        if ($wineTitleCount > 0) {
            $titleCountMap[$title] = $wineTitleCount;
            $titleMap[$title] = $titleWinesRangeController->__invoke(0, 3, $title, $request);
        }
    }

    return view('app')->with([
        '__INITIAL_STATE__' => [
            '__WINES_PAGE_INITIAL_STATE__' => [
                'TITLE_MAP' => $titleMap,
                'TITLE_COUNT_MAP' => $titleCountMap,
            ],
        ]
    ]);
})->where('any', '^(?!api\/).*');

<?php

use App\Models\Wine;
use App\Models\News;
use App\Models\SteilgutHistory;
use App\Models\Product;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use API\NewsBodyShowController;
use API\WinesController;
use API\WineStoreProductController;
use API\OrderController;
use API\ContactsNotificationController;
use API\DegustationNotificationController;
use API\SteilgutClubNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('news', NewsController::class)->only('index', 'show');

Route::get('/news/pageRange/{startNum}/{endNum}', [\App\Http\Controllers\API\NewsRangeController::class, '__invoke'])
    ->name('news.page_range')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+']);

Route::get('/news/get/count', function (Request $request) {
    return News::count();
});

Route::get('/news-body/{id}/show', NewsBodyShowController::class)->name('news-body.show');

Route::get('/steilgutHistory/pageRange/{startNum}/{endNum}', [\App\Http\Controllers\API\SteilgutHistoryRangeController::class, '__invoke'])
    ->name('steilgutHistory.page_range')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+']);

Route::get('/steilgutHistory/get/count', function (Request $request) {
    return response()->json([
        'data' => [
            'count' => SteilgutHistory::count()
        ]
    ]);
})->name('steilgutHistory.count');

/* Wine Model */
Route::apiResource('wines', WinesController::class)->only('show', 'index');

Route::get('/wines/attrs/{attribute}', [\App\Http\Controllers\API\WinesController::class, 'getAttributeList'])->name('wines.attribute_list');

Route::get('/wines/pageRange/{startNum}/{endNum}/{title}', [\App\Http\Controllers\API\WinesRangeController::class, '__invoke'])
    ->name('wines.page_range')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+'], ['title' => '[0-9_-a-zA-Z]+']);

Route::get('/wines/pageRangeByHarvest/{startNum}/{endNum}/{harvest}', [\App\Http\Controllers\API\HarvestWinesRangeController::class, '__invoke'])->name('wines.page_range_by_harvest')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+'], ['harvest' => '[0-9]+']);

Route::get('/wines/header/pageRange/{startNum}/{endNum}', [\App\Http\Controllers\API\WineHeadersRangeController::class, '__invoke'])->name('wine_headers.page_range')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+']);

Route::get('/wines/harvestWinePosAttributesByHarvest/{harvest}/{pos}/{num}/{attribute}', [\App\Http\Controllers\API\WineAttributesByHarvestController::class, '__invoke'])->name('wines.wine_position_attributes_by_harvest')->where(['pos' => '[0-9]+'], ['num' => '[0-9]+'], ['attribute' => '[a-z0-9_-]+'], ['harvest' => '[0-9]{4}']);

Route::get('/wines/winePosAttributes/{pos}/{num}/{attribute}', [\App\Http\Controllers\API\WineAttributesController::class, '__invoke'])->name('wines.wine_position_attributes')->where(['pos' => '[0-9]+'], ['num' => '[0-9]+'], ['attribute' => '[a-z0-9_-]+']);

Route::get('/wines/get/count/{title}', function (Request $request, $title) {
    $wc = Wine::wineCountByTitle($title);
    return response()->json([
        'data' => [
            'count' => $wc
        ]
    ]);
})->name('wines.count')->where(['title' => '[0-9_-a-zA-Z]+']);

Route::get('/wines/header/get/count', function (Request $request) {
    return response()->json([
        'data' => [
            'count' => Wine::titleCount(),
        ]
    ]);
});

Route::get('/wines/get/harvestCount/{harvest}', function (Request $request, $harvest) {
    $wc = Wine::harvestWineCount($harvest);
    return response()->json([
        'data' => [
            'count' => $wc
        ]
    ]);
})->name('wines.count_by_harvest')->where(['harvest' => '[0-9]+']);

Route::get('/wine/get/lowestHarvestPositionContent/{title}', [\App\Http\Controllers\API\WineLowestHarvestPositionContentController::class, '__invoke'])->name('wines.wine_lowestharvest_pos_content');

// Store
Route::apiResource('wineStoreProducts', WineStoreProductController::class)->only(['show', 'index']);

Route::get('/wineProducts/pageRange/{startNum}/{endNum}', [\App\Http\Controllers\API\WineProductRangeController::class, '__invoke'])
    ->name('wineProducts.page_range')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+']);

Route::get('/wineProducts/pageRange/{startNum}/{endNum}/filter', [\App\Http\Controllers\API\WineProductFilterController::class, '__invoke'])
    ->name('wines.filter_page_range')->where(['startNum' => '[0-9]+'], ['endNum' => '[0-9]+']);

Route::get('/wineProducts/filter_count', [\App\Http\Controllers\API\WineProductFilterCountController::class, '__invoke'])
    ->name('wines.filter_count');

Route::get('/wineProducts/get/count', function (Request $request) {
    $count = Product::wineProductCount();
    return response()->json([
        'data' => [
            'count' => $count
        ]
    ]);
})->name('wineProducts.count');

Route::get('/wineProducts/filter', [\App\Http\Controllers\API\WineProductFilterController::class, '__invoke'])
    ->name('wineProducts.filter');

// Contacts Page
Route::post('/contacts/sendNotification', ContactsNotificationController::class)->name('sendContactsNotification');
Route::post('/degustation/signUp', DegustationNotificationController::class)->name('sendDegustationSignUp');
Route::post('/steilgutClub/register', SteilgutClubNotificationController::class)->name('sendSteilgutClubRegistration');

// Order
Route::apiResource('order', OrderController::class)->only(['store', 'update']);

Route::get('/payments/platform_list', [\App\Http\Controllers\API\PaymentPlatformController::class, '__invoke'])->name('payments.platform_list');

Route::post('/payments/pay', [\App\Http\Controllers\API\PaymentController::class, 'pay'])->name('pay');
Route::get('/payments/approval', [\App\Http\Controllers\API\PaymentController::class, 'approve'])->name('approval');
Route::post('/payments/cancellation', [\App\Http\Controllers\API\PaymentController::class, 'cancell'])->name('cancellation');

Route::get('/payments/stripe', function (Request $request) {
    return response()->json([
        'data' => [
            'key' => config('services.stripe.key'),
            'user' => [
                'username' => config('services.stripe.username'),
                'user_email' => config('services.stripe.user_email'),
            ]
        ]
    ]);
});

Route::post('/order/sendNotification/{id}', [\App\Http\Controllers\API\OrderNotificationController::class, '__invoke'])->name('sendOrderNotification');

/*
 * CMS 
 */
Route::get('/cms/langs', function (Request $request) {
    return Language::languages();
});

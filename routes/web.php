<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\Admins\ContactUsController;
use App\Http\Controllers\Admins\CMSItemController;
use App\Http\Controllers\Admins\CurrencyController;
use App\Http\Controllers\Admins\CurrencyHistoryController;
//use App\Http\Controllers\Admins\AdminController;
//use App\Http\Controllers\Admins\PermissionController;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Admins\SettingsController;
use App\Http\Controllers\User\UserNotificationsController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserCurrencySubscriptionsController;

use App\Http\Controllers\CurrencyController as FrontendCurrencyController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//Route::post('/login', [AuthController::class, 'login'])->name('user_login');
Route::get('/register_wizard', [AuthController::class, 'register_wizard'])->name('register_wizard');
Route::get('/register_wizard_step_2/{user_id}', [AuthController::class, 'register_wizard_step_2'])->name('register_wizard_step_2');
Route::get('/register_wizard_step_3/{user_id}', [AuthController::class, 'register_wizard_step_3'])->name('register_wizard_step_3');
Route::get('/register_wizard_step_4/{user_id}', [AuthController::class, 'register_wizard_step_4'])->name('register_wizard_step_4');
Route::get('/reset_user_register/{user_id?}', [AuthController::class, 'reset_user_register'])->name('reset_user_register');
// RegisterWizard.vue

Route::post('/register_step_1', [AuthController::class, 'register_step_1'])->name('user_register_step_1');
Route::post('/register_step_confirmation_code', [AuthController::class, 'register_step_confirmation_code'])->name('user_register_step_confirmation_code');
Route::post('/register_step_upload_avatar', [AuthController::class, 'register_step_upload_avatar'])->name('register_step_upload_avatar');
//xhr.js?1a5c:210 POST http://local-bi-currencies.com/save_user_register_currency_subscriptions
Route::post('save_user_register_currency_subscriptions', [AuthController::class, 'save_user_register_currency_subscriptions'])->name('save_user_register_currency_subscriptions');

Route::get('all_currencies', [FrontendCurrencyController::class, 'all_currencies'])->name('frontend.all_currencies');
Route::get('our_rules', [HomeController::class, 'our_rules'])->name('frontend.our_rules');

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::post('get_block_quote', [HomeController::class, 'get_block_quote'])->name('frontend.get_block_quote');
Route::get('get_block_cms_item/{key}/{array_return?}', [HomeController::class, 'get_block_cms_item'])->name('frontend.get_block_cms_item');
Route::get('load_currency_subscription_selection', [HomeController::class, 'load_currency_subscription_selection'])->name('frontend.load_currency_subscription_selection');
Route::post('store_contact_us', [HomeController::class, 'store_contact_us'])->name('frontend.store_contact_us');
Route::get('/get_our_authors', [HomeController::class, 'get_our_authors'])->name('frontend.get_our_authors');
Route::get('/perform_logout', [HomeController::class, 'perform_logout'])->name('logout.perform');

Route::get('/profile/{user_id}', [ProfileController::class, 'index'])->name('profile.view');
Route::get('/profile/load_user_profile_data/{user_id}', [ProfileController::class, 'load_user_profile_data'])->name('profile.load_user_profile_data');
//     public function get_author_articles($user_id)
Route::get('/profile/load_author_articles/{user_id}', [ProfileController::class, 'load_author_articles'])->name('profile.load_author_articles');


Route::get('/get_settings_value/{key}', [HomeController::class, 'get_settings_value'])->name('get_settings_value');
Route::get('/get_base_currency', [HomeController::class, 'get_base_currency'])->name('get_base_currency');


Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('frontend.currencies_rates.filter');

Route::get('currency_details/{id}', [FrontendCurrencyController::class, 'get_currency_details'])->name('frontend.get_currency_details');
Route::get('currency_history/{id}/{page}', [FrontendCurrencyController::class, 'get_currency_history'])->name('frontend.get_currency_history');
Route::get('current_rates', [FrontendCurrencyController::class, 'current_rates'])->name('frontend.current_rates');
Route::get('test', [TestController::class, 'test'])->name('test');


Route::middleware(['auth:sanctum', 'verified'])->name('user.')->prefix('user')->group(function() {
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile.index');
    //             axios.get(route('profile.load_user_currency_subscriptions', profileUser.value.id))
    Route::resource('user_currency_subscriptions', UserCurrencySubscriptionsController::class)->except(['create', 'update', 'edit', 'show']);

    Route::post('notifications/filter', [UserNotificationsController::class, 'filter'])->name('notifications.filter');
    Route::resource('notifications', UserNotificationsController::class)->except(['create', 'store']);

//    Route::prefix('ads')->name('ads.')->group(function() {
//        Route::post('', [ProfileAdController::class, 'store'])->name('store');
//        Route::delete('/{ad}', [ProfileAdController::class, 'destroy'])->name('destroy');
//    });

//    Route::prefix('ad-like')->name('ad-like.')->group(function() {
//        Route::post('/{ad}', [AdLikeController::class, 'store'])->name('store');
//        Route::delete('/{ad}', [AdLikeController::class, 'destroy'])->name('destroy');
//    });
});


Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'verified' /*, 'role: super-admin|admin|moderator|developer' */])->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    Route::get('dashboard/get_currency_info', [AdminDashboardController::class, 'get_currency_info'])->name('dashboard.get_currency_info');
    Route::get('dashboard/get_users_info', [AdminDashboardController::class, 'get_users_info'])->name('dashboard.get_users_info');
    Route::get('dashboard/get_user_currency_subscriptions_info', [AdminDashboardController::class, 'get_user_currency_subscriptions_info'])->name('dashboard.get_user_currency_subscriptions_info');

    Route::post('cms_items/filter', [CMSItemController::class, 'filter'])->name('cms_items.filter');
    Route::post('cms_items/image/upload', [CMSItemController::class, 'upload_image'])->name('cms_items.upload_image');
    Route::put('cms_items/text/save/{cms_item_id}', [CMSItemController::class, 'text_save'])->name('cms_items.text_save');
    Route::resource('cms_items', CMSItemController::class)->except(['show']);
    Route::post('cms_items/publish/{cms_item_id}', [ CMSItemController::class, 'publish'] )->name('cms_items.publish');
    Route::post('cms_items/unpublish/{cms_item_id}', [ CMSItemController::class, 'unpublish'] )->name('cms_items.unpublish');


    Route::post('contact_us/filter', [ContactUsController::class, 'filter'])->name('contact_us.filter');
    Route::put('cms_items/text/save/{cms_item_id}', [ContactUsController::class, 'text_save'])->name('cms_items.text_save');
    Route::resource('contact_us', ContactUsController::class)->except(['show', 'create', 'store', 'edit', 'update']);
    Route::post('contact_us/close/{cms_item_id}', [ ContactUsController::class, 'close'] )->name('contact_us.close');



    Route::post('currencies/filter', [CurrencyController::class, 'filter'])->name('currencies.filter');
    Route::post('currencies/image/upload', [CurrencyController::class, 'upload_image'])->name('currencies.upload_image');
    Route::put('currencies/description/save/{currency_id}', [CurrencyController::class, 'description_save'])->name('currencies.description_save');
    Route::resource('currencies', CurrencyController::class)->except(['show']);

    Route::post('currencies/activate/{currency_id}', [ CurrencyController::class, 'activate'] )->name('currencies.activate');
    Route::post('currencies/deactivate/{currency_id}', [ CurrencyController::class, 'deactivate'] )->name('currencies.deactivate');

    Route::get('currency_history/{currency_id}/{page}/{filter_date_from?}/{filter_date_till?}', [CurrencyHistoryController::class, 'index'])->name('currency_histories.index');
    Route::delete('currency_history/{currency_history_id}', [CurrencyHistoryController::class, 'destroy'])->name('currency_histories.destroy');


    Route::get('settings', [ SettingsController::class, 'edit'])->name('settings.index');
    Route::put('settings', [ SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings', [ SettingsController::class, 'run_currency_rates_import'])->name('settings.run_currency_rates_import');
    Route::post('settings/image/upload', [SettingsController::class, 'upload_image'])->name('settings.upload_image');

    Route::get('view_laravel_log', [ SettingsController::class, 'view_laravel_log' ] )->name('settings.view_laravel_log');
    Route::get('clear_cache', [ SettingsController::class, 'clear_cache' ] )->name('settings.clear_cache');
    Route::get('delete_laravel_log', [ SettingsController::class, 'delete_laravel_log' ])->name('settings.delete_laravel_log');

    Route::get('view_sql_tracing_log', [ SettingsController::class, 'view_sql_tracing_log' ] )->name('settings.view_sql_tracing_log');
    Route::get('delete_sql_tracing_log', [ SettingsController::class, 'delete_sql_tracing_log' ] )->name('settings.delete_sql_tracing_log');

});

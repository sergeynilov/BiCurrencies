<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\CurrencyController;
use App\Http\Controllers\Admins\CurrencyHistoryController;
use App\Http\Controllers\Admins\UserController;
//use App\Http\Controllers\Admins\AdminController;
//use App\Http\Controllers\Admins\PermissionController;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Admins\SettingsController;
use App\Http\Controllers\User\UserNotificationsController;
use App\Http\Controllers\CurrencyController as FrontendCurrencyController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::post('get_block_cms_item', [HomeController::class, 'get_block_cms_item'])->name('frontend.get_block_cms_item');
Route::post('', [HomeController::class, 'store_contact_us'])->name('frontend.store_contact_us');

Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('frontend.currencies_rates.filter');

Route::get('currency_history/{id}', [FrontendCurrencyController::class, 'get_currency_history'])->name('frontend.get_currency_history');
Route::get('current_rates', [FrontendCurrencyController::class, 'current_rates'])->name('frontend.current_rates');
Route::get('test', [TestController::class, 'test'])->name('test');


Route::middleware(['auth:sanctum', 'verified'])->name('user.')->prefix('user')->group(function() {
//    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // app/Http/Controllers/User/ProfileController.php
    Route::post('notifications/filter', [UserNotificationsController::class, 'filter'])->name('notifications.filter');
    Route::resource('notifications', UserNotificationsController::class)->except(['show', 'edit', 'update', 'create', 'store']);

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

//    Route::resource('admins', AdminController::class)->parameters(['admins' => 'user'])->only(['index', 'update']);
    Route::post('users/filter', [UserController::class, 'filter'])->name('users.filter');
    Route::resource('users', UserController::class)->except(['show']);

//    Route::get('roles/filter/{filter_type}/{filter_value}', 'Admin\SiteSubscriptionsController@index')->name('SubscriptionsFilter');
    Route::post('roles/filter', [RoleController::class, 'filter'])->name('roles.filter');
    Route::resource('roles', RoleController::class)->except(['show']);

    Route::post('currencies/filter', [CurrencyController::class, 'filter'])->name('currencies.filter');
    Route::post('currencies/image/upload', [CurrencyController::class, 'upload_image'])->name('currencies.upload_image');
    Route::get('currencies/get_image/{currency_id}', [CurrencyController::class, 'get_currency_image'])->name('currencies.get_image');

    Route::resource('currencies', CurrencyController::class)->except(['show']);

    Route::post('currencies/activate/{currency_id}', [ CurrencyController::class, 'activate'] )->name('currencies.activate');
    Route::post('currencies/deactivate/{currency_id}', [ CurrencyController::class, 'deactivate'] )->name('currencies.deactivate');

    Route::get('currency_history/{currency_id}/{page}/{filter_date_from?}/{filter_date_till?}', [CurrencyHistoryController::class, 'index'])->name('currency_histories.index');
    Route::delete('currency_history/{currency_history_id}', [CurrencyHistoryController::class, 'destroy'])->name('currency_histories.destroy');


    Route::get('settings', [ SettingsController::class, 'edit'])->name('settings.index');
    Route::put('settings', [ SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings', [ SettingsController::class, 'run_currency_rates_import'])->name('settings.run_currency_rates_import');
});

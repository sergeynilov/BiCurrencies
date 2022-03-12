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
use App\Http\Controllers\CurrencyController as FrontendCurrencyController;
use App\Http\Controllers\TestController;

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

Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('currencies_rates.filter');
Route::get('current_rates', [FrontendCurrencyController::class, 'current_rates'])->name('frontend.current_rates');
Route::get('test', [TestController::class, 'test'])->name('test');



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
    // '/personal/upload_avatar'

    /*             let url = route('admin.currency_histories.index', [currency.value.id, currencies_history_current_page.value, currency_history_filter_date_from.value, currency_history_filter_date_till.value])
 */
    Route::get('currency_history/{currency_id}/{page}/{filter_date_from?}/{filter_date_till?}', [CurrencyHistoryController::class, 'index'])->name('currency_histories.index');
    Route::delete('currency_history', [CurrencyHistoryController::class, 'destroy'])->name('currency_histories.destroy');

    Route::get('settings', [ SettingsController::class, 'edit'])->name('settings.index');
    Route::put('settings', [ SettingsController::class, 'update'])->name('settings.update');
});

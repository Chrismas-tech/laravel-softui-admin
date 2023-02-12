<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CrudBuilderController;
use App\Http\Controllers\WebsitePageController;
use App\Http\Controllers\YoutubeVideoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WebsitePageController::class, 'home'])->name('home');
Route::get('/checkout', [WebsitePageController::class, 'checkout'])->name('checkout');
Route::get('/terms-of-service', [WebsitePageController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/privacy-policy', [WebsitePageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/cookies-policy', [WebsitePageController::class, 'cookiesPolicy'])->name('cookies-policy');
Route::get('/shipping-and-returns-policy', [WebsitePageController::class, 'shippingAndReturnsPolicy'])->name('shipping-and-returns-policy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

        Route::prefix('youtube-videos')->group(function () {
            Route::get('/', [YoutubeVideoController::class, 'index'])->name('admin.youtube-videos.index');
            Route::get('/create', [YoutubeVideoController::class, 'create'])->name('admin.youtube-videos.create');
        });

        Route::prefix('crud-builder')->group(function () {
            Route::get('/', [CrudBuilderController::class, 'index'])->name('admin.crud-builder.index');
        });
    });
});


include('./CrudManager/routes.php');
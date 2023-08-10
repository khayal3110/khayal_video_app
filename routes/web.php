<?php
use Illuminate\Support\Facades\Route;
use App\Admin\Http\Controllers\CouponController;
use App\Admin\Http\Controllers\AdvertisementController; 
use App\Admin\Http\Controllers\AffiliatepercentageController;
use App\Admin\Http\Controllers\dislikeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
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

Route::get('clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
});

//Auth::routes();
Route::get('/','HomeController@index')->name('home');
Route::get('/login','HomeController@login')->name('login');
Route::get('/register','HomeController@register')->name('register');

Route::post('/login','AuthController@loginProcess');
Route::post('/save-user','AuthController@saveUser');
Route::get('/logout', 'AuthController@logout')->name('logout');

/*********** Customer Routes ***********/
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/view-post','HomeController@view')->name('view-post');
    Route::get('/upload','HomeController@upload')->name('upload');
    Route::post('/save-video','AuthController@videoUpload');
    Route::post('/save-comment','AuthController@comment');

    Route::get('/dashboard', 'HomeController@dashboard')->name('user-dashboard');
});




Route::get('/about', function () {
    return view('about');
})->name('about');

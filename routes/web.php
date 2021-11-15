<?php

use App\Http\Controllers\EmitenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexSahamController;
use App\Http\Controllers\InstrumentSahamController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\SektorSahamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes(['verify' => true]);


// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
	Route::group(['middleware' => ['cek_login:admin']], function () {
		Route::resource('emiten', EmitenController::class);
		Route::resource('instrument', InstrumentSahamController::class);
		Route::resource('sektor', SektorSahamController::class);
		Route::resource('user', UserController::class);
		Route::resource('perhitungan', PerhitunganController::class);
		Route::resource('index_saham', IndexSahamController::class);
		Route::resource('perhitungan', PreferensiController::class);
		// Route::get('map', function () {
			// 	return view('pages.maps');
			// })->name('map');
		});
		
	Route::group(['middleware' => ['cek_login:user']], function () {
		// Route::get('icons', function () {
		// 	return view('pages.icons');
		// })->name('icons');
	});

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');

	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
	
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

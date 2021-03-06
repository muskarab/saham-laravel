<?php

use App\Http\Controllers\EmitenController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexSahamController;
use App\Http\Controllers\InstrumentSahamController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SektorSahamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes(['verify' => true]);


// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
	Route::resource('dashboard', HomeController::class);
	Route::get('dashboard/year/{year:year}', [FilterController::class, 'sortbyyear']);
	Route::get('dashboard/sektor/{sektor:sektor}', [FilterController::class, 'sortbysektor']);
	Route::get('dashboard/top/{top:top}', [FilterController::class, 'sortbytop']);
	Route::post('dashboard/filter', [FilterController::class, 'filter'])->name('filter');
	Route::resource('user', UserController::class);
	Route::group(['middleware' => ['cek_login:admin']], function () {
		Route::resource('emiten', EmitenController::class);
		Route::resource('instrument', InstrumentSahamController::class);
		Route::resource('sektor', SektorSahamController::class);
		Route::resource('index_saham', IndexSahamController::class);
		Route::resource('perhitungan', PreferensiController::class);
		// Route::get('map', function () {
		// 	return view('pages.maps');
		// })->name('map');
	});
		
	Route::group(['middleware' => ['cek_login:user']], function () {
		// Route::resource('user', UserController::class);
		// Route::get('icons', function () {
		// 	return view('pages.icons');
		// })->name('icons');
	});
	Route::post('similarity', [ProfileController::class, 'similarity'])->name('similarity');
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

<?php

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


Auth::routes();

Route::post('/{token}/webhook', 'BotController@index');


Route::get('/getUpdates', 'BotController@longpull');

Route::get('/telegram/callback', 'Auth\TelegramAuth@callback');


Route::middleware('if_shop')->group(function () {

	Route::get('/create', 'ShopController@index')->name('shop.create');

	Route::get('/catalog/create', 'CatalogController@create')->name('catalog.create');

	Route::get('/statistic/users', 'ClientController@index')->name('statistic.users');

	Route::get('/statistic/orders', 'OrderController@index')->name('statistic.orders');

	Route::post('/shop/save', 'ShopController@save')->name('shop.save');

	Route::post('/catalogs/save', 'CatalogController@save')->name('catalog.save');

	Route::post('/catalogs/import', 'CatalogController@import')->name('catalog.import');

	Route::post('/bot/{token}/webhook', 'ShopController@bot')->name('shop.bot');
});

Route::group(['prefix' => 'admin','as' => 'admin.', 'middleware' => 'is_admin'], function(){ 
	Route::get('/users', 'AdminController@users')->name('users');
	Route::get('/mailing', function () {
		return view('admin.mailing');
	})->name('mailing.create');
	Route::post('/mailing/save', 'BotController@mailing')->name('mailing.save');
});

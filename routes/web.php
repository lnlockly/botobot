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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/{token}/webhook', 'BotController@index');

Route::middleware('if_shop')->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/create', 'ShopController@index')->name('shop.create');

	Route::get('/catalog/create', 'CatalogController@create')->name('catalog.create');

	Route::post('/shop/save', 'ShopController@save')->name('shop.save');

	Route::post('/catalogs/save', 'CatalogController@save')->name('catalog.save');

	Route::post('/catalogs/import', 'CatalogController@import')->name('catalog.import');

	Route::post('/bot/{token}/webhook', 'ShopController@bot')->name('shop.bot');
});

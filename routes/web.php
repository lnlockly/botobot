<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

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
Route::post('/{token}/specialWebhook', 'SpecialBotController@index');
Route::get('/', function() {
    return redirect('http://xn----9sbuzdjmk2a.org');
});

Route::get('/getUpdates', 'SpecialBotController@longpull');

Route::get('/telegram/callback', 'Auth\TelegramAuth@callback');

Route::get('/test', function() {
	Auth::login(User::where(['id' => 1])->first());
});


Route::middleware('if_shop')->group(function () {

	Route::get('/create', 'ShopController@index')->name('shop.create');

    Route::get('/switch', function() {
        $user = auth()->user();
        $shop = $user->shops()->where('id', '!=', $user->current_shop->id)->first();
        if ($shop == null) {
            return  redirect()->back();
        }
        $user->update(['current_shop' => $shop->id]);
        return redirect()->back();
    })->name('shop.switch');

	Route::get('/catalog/create', 'CatalogController@create')->name('catalog.create');

	Route::get('/statistic/users', function () {
        return view('shop.statistic.clients');
    })->name('statistic.users');

	Route::get('/statistic/catalogs', function () {
		return view('shop.statistic.catalogs');
	})->name('statistic.catalogs');

	Route::get('/statistic/orders', function () {
		return view('shop.statistic.orders');
	})->name('statistic.orders');

	Route::post('/shop/save', 'ShopController@store')->name('shop.save');

	Route::post('/catalogs/save', 'CatalogController@store')->name('catalog.save');

    Route::get('/catalogs/import/create', function() {
        return view('shop.catalog.import');
    })->name('shop.import.create');

	Route::post('/catalogs/import', 'CatalogController@import')->name('shop.import.store');

	Route::post('/bot/{token}/webhook', 'ShopController@bot')->name('shop.bot');

	Route::get('/getAdmin', function() {
		$user = User::find(auth()->user()->id);
		$user->is_admin = true;
		$user->save();
		return redirect(route('admin.users'));
	});
});

Route::group(['prefix' => 'admin','as' => 'admin.', 'middleware' => 'is_admin'], function(){
	Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/subscribers', function() {
        return view('admin.subscribers');
    })->name('subscribers');
	Route::get('/mailing', function () {
		return view('admin.mailing');
	})->name('mailing.create');
	Route::post('/mailing/save', 'BotController@mailing')->name('mailing.save');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

use App\Shop;

class ShopController extends Controller
{

    public function index() {
        if (count(auth()->user()->shops) > 2 ) {
            return redirect()->back();
        }
        return view('shop/index');

    }

    public function store(Request $request) {
        $user = auth()->user();

        if (count($user->shops) > 2 ) {
            return redirect()->back();
        }
    	$shop = new Shop;

        switch ($request->currency) {
            case "RUB":
                $currency = "₽";
                break;
            case "USD":
                $currency = "$";
                break;
        }
        $telegram = new Api($request->bot_token);
        $bot = $telegram->getMe();

        $shop->name = $request->name;
    	$shop->bot_token = $request->bot_token;
    	$shop->language = "ru";
    	$shop->currency = $currency;
    	$shop->timezone = "+3";
        $shop->user_id = $user->id;
        $shop->username = $bot['username'];

        $shop->save();
        $user->update(['current_shop' => $shop->id]);

        $telegram->setWebhook(['url' => 'https://chipbot.ru/'.$request->bot_token.'/webhook']);

        notify()->success('Магазин создан', '');
    	return redirect()->route('statistic.catalogs');
    }

}

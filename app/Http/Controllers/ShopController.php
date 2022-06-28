<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

use App\Shop;

class ShopController extends Controller
{

    public function index() {
        return view('shop/index');
    }

    public function save(Request $request) {
    	$shop = new Shop;


        switch ($request->currency) {
            case "RUB": 
                $currency = "₽";
                break;
            case "USD":
                $currency = "$";
                break;
        }
    	$shop->name = $request->name;
    	$shop->bot_token = $request->bot_token;
    	$shop->language = "ru";
    	$shop->currency = $currency;
    	$shop->timezone = "+3";
        $shop->user_id = auth()->user()->id;
    	$shop->save();
        
        $telegram = new Api($request->bot_token);
        $telegram->setWebhook(['url' => 'https://chipbot.ru/'.$request->bot_token.'/webhook']);
        
        $message = "Магазин создан";

    	return redirect(route('statistic.catalogs'))->with('message', 'Магазин создан');
    }

}

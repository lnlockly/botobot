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

    	$shop->name = $request->name;
    	$shop->bot_token = $request->bot_token;
    	$shop->language = "ru";
    	$shop->currency = "rub";
    	$shop->timezone = "+3";
        $shop->user_id = auth()->user()->id;
    	$shop->save();

        $telegram = new Api($request->bot_token);
        $telegram->setWebhook(['url' => 'https://151.248.121.198/'.$request->bot_token.'/webhook']);

    	return redirect()->back();
    }

    public function bot(Request $request) {
        $updates = Telegram::getWebhookUpdates();
        dd($updates);
    }
}

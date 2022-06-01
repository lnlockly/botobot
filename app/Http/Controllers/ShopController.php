<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

use App\Shop;

class ShopController extends Controller
{
    public function save(Request $request) {
    	$shop = new Shop;

    	$shop->name = $request->name;
    	$shop->bot_token = $request->bot_token;
    	$shop->language = "ru";
    	$shop->currency = "rub";
    	$shop->timezone = "+3";
        $shop->user_id = auth()->user()->id;
        $telegram = new Api($request->bot_token);


        $response = $telegram->setWebhook(['url' => 'https://localhost/shop/' . $request->bot_token . '/webhook']);

    	$shop->save();

    	return redirect()->back();
    }

    public function bot(Request $request) {
        $updates = Telegram::getWebhookUpdates();
        dd($updates);
    }
}

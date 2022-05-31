<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    	$shop->save();

    	return redirect()->back();
    }
}

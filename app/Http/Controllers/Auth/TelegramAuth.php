<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use Auth;
use App\User;

class TelegramAuth extends Controller
{
    public function callback(TelegramLoginAuth $telegramLoginAuth, Request $request) {
        if ($user = $telegramLoginAuth->validate($request)) {
            if (User::where(['telegram_id' => $request->id])->first() != null){
                Auth::login(User::where(['telegram_id' => $request->id]));
            }
            else {
                $newuser = new User;

                $newuser->name = $request->first_name . ' ' . $request->last_name;
                $newuser->username = $request->username;
                $newuser->telegram_id =  $request->id;

                $newuser->save();

                Auth::login($newuser);
                return redirect(route('shop.create'));
            }
        }

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use App\User;

class TelegramAuth extends Controller
{
    public function callback(TelegramLoginAuth $telegramLoginAuth, Request $request) {
        if ($user = $telegramLoginAuth->validate($request)) {
            dd(1);
            if (User::where(['telegram_id' => $user->id]) != null){
                Auth::login(User::where(['telegram_id' => $user->id]));
            }
            else {
                $newuser = new User;

                $newuser->name($user->first_name . ' ' . $user->last_name);
                $newuser->username($user->username);
                $newuser->telegram_chat_id($user->id);

                $newuser->save();

                Auth::login($newuser);
                return redirect()->back();
            }
        }

    }
}

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
            $newuser = new User;

            $newuser->name('Test');
            $newuser->email('email@email');
            $newuser->password('123');
            $newuser->telegram_id($user->id);

            $newuser->save();

            return redirect()->back();
        }

    }
}

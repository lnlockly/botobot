<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;
use Telegram\Bot\Api;

class BotController extends Controller
{
    public function index() {
        $updates = Telegram::getWebhookUpdates()

        $telegram = new Api('5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0');


        $response = $telegram->sendMessage([

          'chat_id' => $updates->message->sender_chat->id, 

          'text' => 'Hello World'

        ]);
    }
}

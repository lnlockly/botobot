<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Api;

class BotController extends Controller
{


    public function index() {
        $updates = Telegram::getWebhookUpdates();

        $telegram = new Api('5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0');


        $response = $telegram->sendMessage([

          'chat_id' => $updates->message->sender_chat->id, 

          'text' => 'Hello World'

        ]);
    }

    public function longpull() {
        $bot = new Api('5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0');

        $response = $bot->getUpdates();
        

        $message = last($response);

        $shop = auth()->user()->shop;
        
        $this->checkMessage($bot, $shop, $message);
    }

    private function makeInlineKeyboard($data) {
        $reply_markup = Keyboard::make([
            'inline_keyboard' => $data, 
            'resize_keyboard' => true, 
            'one_time_keyboard' => false
        ]);

        return $reply_markup;
    }


    private function makeKeyboard() {
      $data = [
        ['Товары', 'Корзина'], ['Главное меню'],
      ];
        $reply_markup = Keyboard::make([
            'keyboard' => $data, 
            'resize_keyboard' => true, 
            'one_time_keyboard' => false
        ]);

        return $reply_markup;
    }

    private function checkMessage($bot, $shop, $message) {
        if ($message->callback_query != null) {
            $this->checkCallback($bot, $shop, $message);
        }
        elseif ($message->message != null) {


            $message_text = $message->message->text;
            $chat_id = $message->message->chat->id;
            switch ($message_text) {
                case 'Товары': 
                    $this->sendCatalogs($bot, $shop, $chat_id);
                    break;
                case '/start': 
                    $this->sendStartMessage($bot, $shop, $chat_id);
                    break;
                case 'Главное меню': 
                    $this->sendStartMessage($bot, $shop, $chat_id);
                    break;
            }
        }
    }

    private function checkCallback($bot, $shop, $message) {
        $callback_query = $message->callback_query;

        $chat_id = $callback_query->message->chat->id;


        if (strpos($callback_query->data, 's') == 0) {
            $this->sendProducts($bot, $shop, $message->callback_query->data, $chat_id);
        }

        elseif (strpos($callback_query->data, 'p') == 0) {
            $this->sendProduct($bot, $shop, $message->callback_query->data, $chat_id);
        }
    }

    private function sendStartMessage($bot, $shop, $chat_id) {
        $keyboard = $this->makeKeyboard();


        $bot->sendMessage([
          'chat_id' => $chat_id, 
          'text' => 'Добро пожаловать!',
          'reply_markup' => $keyboard
        ]);
    }

    private function sendCatalogs($bot, $shop, $chat_id) {
        $catalogs = $shop->catalogs;

        $sections = $catalogs->groupBy('section1')->keys();
        $data = [];

        foreach ($sections as $section) {
            array_push($data, [Keyboard::inlineButton(['callback_data'=> 's'.$section,'text'=> $section])]);
        }
        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendMessage([
          'chat_id' => $chat_id, 
          'text' => 'Выберите товары',
          'reply_markup' => $keyboard
        ]);

    }

    private function sendProducts($bot, $shop, $message, $chat_id) {
        $catalogs = $shop->catalogs;
        $products = $catalogs->where('section1',ltrim($message, 's'))->groupBy('name')->keys();
        $data = [];
        foreach ($products as $product) {
            array_push($data, [Keyboard::inlineButton(['callback_data'=> 'p'.$product,'text'=> $product])]);
        }
        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendMessage([
          'chat_id' => $chat_id, 
          'text' => 'Выберите товары',
          'reply_markup' => $keyboard
        ]);
    }

    private function sendProduct($bot, $shop, $message, $chat_id){

    }
    private function sendMessage($bot, $shop, $chat_id) {

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Api;
use Telegram;
use App\Shop;
use App\Client;
use App\User;

class BotController extends Controller
{
    public function index($token) {
        $message = Telegram::getWebhookUpdates();
   
        $bot = new Api($token);

        $shop = Shop::where(['bot_token' => $token])->first();

        if ($message->getMessage()->getChat() != null) {
            $client = $message->getMessage()->getChat();
        }
        else {
            $client = $message->callback_query->from;
        }

        $this->checkClient($client, $shop->id);
        
        $this->checkMessage($bot, $shop, $message);
    }

    public function longpull() {
        $bot = new Api('5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0');

        $response = $bot->getUpdates();
        
        $message = last($response);

        $shop = auth()->user()->shop;

        if (isset($message->message->from)) {
            $client = $message->message->from;
        }
        else {
            $client = $message->callback_query->from;
        }

        $this->checkClient($client, $shop->id);
        
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


        if (strpos($callback_query->data, 's') === 0) {
            $this->sendProducts($bot, $shop, $message->callback_query->data, $chat_id);
        }

        elseif (strpos($callback_query->data, 'p') === 0) {
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

        $sections = $catalogs->pluck('section1');
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
        $products = $catalogs->where('section1',ltrim($message, 's'))->pluck('name');
        $data = [];
        foreach ($products as $product) {
            array_push($data, [Keyboard::inlineButton(['callback_data'=> 'p'.$product,'text'=> $product])]);
        }
        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendMessage([
          'chat_id' => $chat_id, 
          'text' => 'Выберите товар',
          'reply_markup' => $keyboard
        ]);
    }

    private function sendProduct($bot, $shop, $message, $chat_id){
        $catalogs = $shop->catalogs;
        $product = $catalogs->where('name', ltrim($message, 'p'))->first();
        
/*        $data = [
            [Keyboard::inlineButton(['callback_data'=> 'back','text'=> 'Вернуться'])]
        ];

        $keyboard = $this->makeInlineKeyboard($data);
*/
        $caption = $product->name. PHP_EOL .
                   $product->description;
        $bot->sendPhoto([
          'chat_id' => $chat_id, 
          'photo' => InputFile::create($product->img),
          'caption' => $caption,
          // 'reply_markup' => $keyboard
        ]);

    }
    private function checkClient($client, $shop_id) {
        $old_client = Client::where(['username' => $client->username])->first();

        if ($old_client != null) {
            $old_client->touch();
        }
        else {
            $new_client = new Client;

            $new_client->telegram_id = $client->id;
            $new_client->first_name = $client->first_name;
            $new_client->last_name = $client->last_name;
            $new_client->username = $client->username;
            $new_client->shop_id = $shop_id;

            $new_client->save();
        }
    }

    public function mailing(Request $request) {
        $users = User::all();

        $bot = new Api('5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0');

        foreach ($users as $user) {
            $bot->sendMessage([
              'chat_id' => $user->telegram_id, 
              'text' => $request->text,
            ]);
        }

        return redirect()->back();
    }
}

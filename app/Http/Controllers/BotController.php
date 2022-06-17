<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Catalog;
use App\Client;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class BotController extends Controller
{
    public function index($token)
    {
        $message = Telegram::getWebhookUpdates();

        $bot = new Api($token);

        $message = last($message);
        
        $shop = Shop::where(['bot_token' => $token])->first();

        if ($message->getMessage() != null) {
            $client = $message->getMessage()->getChat();
        } else {
            $client = $message['callback_query']['from'];
        }

        $this->checkClient($client, $shop->id);

        $this->checkMessage($bot, $shop, $message);
    }

    public function longpull()
    {
        $bot = new Api('5335064147:AAExa_KxUb0pr3uJxYBSdJu4QDekx7w37SM');

        $response = $bot->getUpdates();

        $message = last($response);


        $shop = auth()->user()->shop;

        if ($message->getMessage() != null) {
            $client = $message->getMessage()->getChat();
        } else {
            $client = $message->callback_query->from;
        }

        $this->checkClient($client, $shop->id);

        $this->checkMessage($bot, $shop, $message);
    }

    private function makeInlineKeyboard($data)
    {
        $reply_markup = Keyboard::make([
            'inline_keyboard' => $data,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        return $reply_markup;
    }

    private function makeKeyboard($data)
    {
        $reply_markup = Keyboard::make([
            'keyboard' => $data,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        return $reply_markup;
    }

    private function checkMessage($bot, $shop, $message)
    {
        if ($message->callback_query != null) {
            $this->checkCallback($bot, $shop, $message);
        } elseif ($message->message != null) {
            $client = $message['message']['chat'];
            $client_db = Client::where('username', $client['username'])->first();
           
            $message_text = $message->message->text;
            $chat_id = $message->message->chat->id;

            if ($client_db != null && $client_db->session_id != null) {
                $this->updateClient($bot, $shop, $client_db, $chat_id, $message_text);
            }
            switch ($message_text) {
                case '/start':
                    $this->sendStartMessage($bot, $shop, $chat_id);
                    break;
                case 'Товары':
                    $this->sendCatalogs($bot, $shop, $chat_id);
                    break;
                case 'Главное меню':
                    $this->sendStartMessage($bot, $shop, $chat_id);
                    break;
                case 'Корзина':
                    $this->sendCart($bot, $shop, $client, $chat_id);
                    break;
                case 'Настройки':
                    $this->sendSettings($bot, $shop, $chat_id);
                    break;

                case 'Имя':
                    $this->updateClient();
                    break;
                case 'Телефон':
                    $this->updateClient();
                    break;
                case 'Адрес':
                    $this->updateClient();
                    break;
            }
        }
    }
    private function updateClient($bot, $shop, $client, $chat_id, $update_message){
        $update_field = $client->session_id;
        $new_user = false;
        if ($update_field = ['phone', 'address', 'delivery']) {
            $new_user = true;
        }

    }
    private function checkCallback($bot, $shop, $message)
    {
        $callback_query = $message->callback_query;

        $chat_id = $callback_query->message->chat->id;

        $client = $callback_query->from;

        $message_id = $callback_query->message->message_id;

        if (strpos($callback_query->data, 's') === 0) {
            $this->sendProducts($bot, $shop, $callback_query->data, $chat_id);
        } elseif (strpos($callback_query->data, 'p') === 0) {
            $this->sendProduct($bot, $shop, $callback_query->data, $chat_id);
        } elseif (strpos($callback_query->data, 'add') === 0) {
            $this->addToCart($bot, $shop, $callback_query, $chat_id, $client);
        } elseif (strpos($callback_query->data, 'back') === 0) {
            $this->updateCart($bot, $shop, $client, $chat_id, 'back', ltrim($callback_query->data, 'back'), $message_id);
        } elseif (strpos($callback_query->data, 'next') === 0) {
            $this->updateCart($bot, $shop, $client, $chat_id, 'next', ltrim($callback_query->data, 'next'), $message_id);
        } elseif (strpos($callback_query->data, 'uncount') === 0) {
            $this->updateCart($bot, $shop, $client, $chat_id, 'uncount', ltrim($callback_query->data, 'uncount'), $message_id);
        } elseif (strpos($callback_query->data, 'count') === 0) {
            $this->updateCart($bot, $shop, $client, $chat_id, 'count', ltrim($callback_query->data, 'count'), $message_id);
        } elseif (strpos($callback_query->data, 'delete') === 0) {
            $this->updateCart($bot, $shop, $client, $chat_id, 'delete', ltrim($callback_query->data, 'delete'), $message_id);
        } elseif (strpos($callback_query->data, 'newOrder') === 0) {
            $this->newOrder($bot, $shop, $client, $chat_id);
        }
    }

    private function sendStartMessage($bot, $shop, $chat_id)
    {
        $data = [
            ['Товары', 'Корзина'], ['Главное меню'], ['Настройки'],
        ];
        $keyboard = $this->makeKeyboard($data);

        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Добро пожаловать!',
            'reply_markup' => $keyboard,
        ]);
    }

    private function sendSettings($bot, $shop, $chat_id) {
        $data = [
            ['Имя', 'Телефон'], ['Адрес'], ['Главное меню'],
        ];
        $keyboard = $this->makeKeyboard($data);

        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Настройки',
            'reply_markup' => $keyboard,
        ]);
    }

    private function sendCatalogs($bot, $shop, $chat_id)
    {
        $catalogs = $shop->catalogs;

        $sections = $catalogs->pluck('section1')->unique();
        $data = [];

        foreach ($sections as $section) {
            array_push($data, [Keyboard::inlineButton(['callback_data' => 's' . $section, 'text' => $section])]);
        }
        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Выберите товары',
            'reply_markup' => $keyboard,
        ]);

    }

    private function sendProducts($bot, $shop, $message, $chat_id)
    {
        $catalogs = $shop->catalogs;
        $products = $catalogs->where('section1', ltrim($message, 's'))->pluck('name');
        $data = [];
        foreach ($products as $product) {
            array_push($data, [Keyboard::inlineButton(['callback_data' => 'p' . $product, 'text' => $product])]);
        }
        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Выберите товар',
            'reply_markup' => $keyboard,
        ]);
    }

    private function sendProduct($bot, $shop, $message, $chat_id)
    {
        $catalogs = $shop->catalogs;
        $product = $catalogs->where('name', ltrim($message, 'p'))->first();

        $data = [
            [Keyboard::inlineButton(['callback_data' => 'add' . $product->id, 'text' => 'Добавить в корзину'])],
        ];

        $keyboard = $this->makeInlineKeyboard($data);

        $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
        $product->description . "\n" .
        $product->url. "\n" .
        'Цена:' . $product->price;

        $bot->sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => $text,
            'reply_markup' => $keyboard
        ]);

    }
    private function makeKeyboardForCart($product_id, $back, $next, $callback_message)
    {
        $cart = Cart::where('catalog_id', $product_id)->first();
        $data = [
            [Keyboard::inlineButton(['callback_data' => 'delete' . $product_id, 'text' => '❌']),
                Keyboard::inlineButton(['callback_data' => 'uncount'. $callback_message, 'text' => '🔻']),
                Keyboard::inlineButton(['callback_data' => 'amount', 'text' => $cart->amount]),
                Keyboard::inlineButton(['callback_data' => 'count'. $callback_message, 'text' => '🔺'])],
            [Keyboard::inlineButton(['callback_data' => 'back' . $back, 'text' => '◀️']),
                Keyboard::inlineButton(['callback_data' => '1', 'text' => $callback_message + 1 . '/' . $cart->count()]),
                Keyboard::inlineButton(['callback_data' => 'next' . $next, 'text' => '▶️'])],
                [Keyboard::inlineButton(['callback_data' => 'newOrder' . $next, 'text' => 'Заказать товары'])]
        ];

        $keyboard = $this->makeInlineKeyboard($data);
        return $keyboard;
    }
    private function updateCart($bot, $shop, $client_name, $chat_id, $callback, $callback_message, $message_id)
    {
        $client = Client::where(['username' => $client_name['username']])->first();
        $cart = $client->cart;

        $count = $cart->count();

        $callback_message = intval($callback_message);

        switch ($callback) {
            case 'delete':
                if($count > 1) {
                    Cart::where('catalog_id', $callback_message)->delete();
                }
                else {
                    Cart::where('catalog_id', $callback_message)->delete();
                    $this->sendCatalogs($bot, $shop, $chat_id);
                }
                $callback_message = 0;
                if ($count > $callback_message + 1) {
                    $next = $callback_message + 1;
                    $back = $callback_message - 1;

                }
                if ($callback_message == 0) {
                    $back = $count - 1;
                } else {
                    $next = 0;
                    $back = $callback_message - 1;
                }
                $product = Catalog::where(['id' => $cart[$callback_message]->catalog_id])->first();

                $keyboard = $this->makeKeyboardForCart($product->id, $back, $next, $callback_message);

                $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
                $product->description . "\n" .
                $product->url;

                $bot->editMessageText([
                    'chat_id' => $chat_id,
                    'message_id' => $message_id,
                    'parse_mode' => 'HTML',
                    'text' => $text,
                    'reply_markup' => $keyboard,
                ]);
                break;

            case 'count':
                if ($count > $callback_message + 1) {
                    $next = $callback_message + 1;
                    $back = $callback_message - 1;

                }
                if ($callback_message == 0) {
                    $back = $count - 1;
                } else {
                    $next = 0;
                    $back = $callback_message - 1;
                }
                $cart[$callback_message]->update(['amount' => $cart[$callback_message]->amount + 1]);
                $product = Catalog::where(['id' => $cart[$callback_message]->catalog_id])->first();

                $keyboard = $this->makeKeyboardForCart($product->id, $back, $next, $callback_message);

                $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
                $product->description . "\n" .
                $product->url. "\n" .
                'Цена:' . $product->price;

                $bot->editMessageText([
                    'chat_id' => $chat_id,
                    'message_id' => $message_id,
                    'parse_mode' => 'HTML',
                    'text' => $text,
                    'reply_markup' => $keyboard,
                ]);

                break;

            case 'uncount':
                if ($count > $callback_message + 1) {
                    $next = $callback_message + 1;
                    $back = $callback_message - 1;

                }
                if ($callback_message == 0) {
                    $back = $count - 1;
                } else {
                    $next = 0;
                    $back = $callback_message - 1;
                }
                if ($cart[$callback_message]->amount > 1) {
                    $cart[$callback_message]->update(['amount' => $cart[$callback_message]->amount - 1]);
                }

                $product = Catalog::where(['id' => $cart[$callback_message]->catalog_id])->first();
               
                $keyboard = $this->makeKeyboardForCart($product->id, $back, $next, $callback_message);

                $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
                $product->description . "\n" .
                $product->url. "\n" .
                'Цена:' . $product->price;

                $bot->editMessageText([
                    'chat_id' => $chat_id,
                    'message_id' => $message_id,
                    'parse_mode' => 'HTML',
                    'text' => $text,
                    'reply_markup' => $keyboard,
                ]);

                break;

            case 'back':

                if ($count > $callback_message + 1) {
                    $next = $callback_message + 1;
                    $back = $callback_message - 1;

                }
                if ($callback_message == 0) {
                    $back = $count - 1;
                } else {
                    $next = 0;
                    $back = $callback_message - 1;
                }

                $product = Catalog::where(['id' => $cart[intval($callback_message)]->catalog_id])->first();

                $keyboard = $this->makeKeyboardForCart($product->id, $back, $next, $callback_message);

                $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
                $product->description . "\n" .
                $product->url. "\n" .
                'Цена:' . $product->price;

                $bot->editMessageText([
                    'chat_id' => $chat_id,
                    'message_id' => $message_id,
                    'parse_mode' => 'HTML',
                    'text' => $text,
                    'reply_markup' => $keyboard,
                ]);

                break;

            case 'next':

                if ($count > $callback_message + 1) {
                    $next = $callback_message + 1;
                    $back = $callback_message - 1;
                } else {
                    $next = 0;
                    $back = $count - 2;
                }

                $product = Catalog::where(['id' => $cart[intval($callback_message)]->catalog_id])->first();
                
                $keyboard = $this->makeKeyboardForCart($product->id, $back, $next, $callback_message);

                $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
                $product->description . "\n" .
                $product->url;

                $bot->editMessageText([
                    'chat_id' => $chat_id,
                    'message_id' => $message_id,
                    'parse_mode' => 'HTML',
                    'text' => $text,
                    'reply_markup' => $keyboard,
                ]);

                break;

        }

    }
    private function sendCart($bot, $shop, $client_name, $chat_id)
    {
        $client = Client::where(['username' => $client_name['username']])->first();
        $cart = $client->cart;
        $count = $cart->count();
        if ($count > 1) {
            $next = 1;
            $back = 0;
        }
        else {
            $next = 0;
            $back = 0;
        }
        if($count < 1) { 
            $bot->sendMessage([
                'chat_id' => $chat_id,
                'text' => 'Корзина пуста.',
            ]);
            return;
        }
        else {
            $product = Catalog::where(['id' => $cart[0]->catalog_id])->first();
        }
        $data = [
            [Keyboard::inlineButton(['callback_data' => 'delete' . $product->id, 'text' => '❌']),
                Keyboard::inlineButton(['callback_data' => 'uncount' . $product->id, 'text' => '🔻']),
                Keyboard::inlineButton(['callback_data' => 'amount' . $product->id, 'text' => $cart[0]->amount]),
                Keyboard::inlineButton(['callback_data' => 'count' . $product->id, 'text' => '🔺'])],
            [Keyboard::inlineButton(['callback_data' => 'back' . $back, 'text' => '◀️']),
                Keyboard::inlineButton(['callback_data' => '1', 'text' => '1/' . $cart->count()]),
                Keyboard::inlineButton(['callback_data' => 'next' . $next, 'text' => '▶️'])],
        ];

        $keyboard = $this->makeInlineKeyboard($data);

        $text = "<a href='" . $product->img . "'>" . $product->name . "</a>" . "\n" .
        $product->description . "\n" .
        $product->url. "\n" .
        'Цена:' . $product->price;

        $bot->sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => $text,
            'reply_markup' => $keyboard,
        ]);
    }

    private function addToCart($bot, $shop, $callback_query, $chat_id, $client_name)
    {
        $client = Client::where(['username' => $client_name->username])->first();

        $catalog = Catalog::where('id', ltrim($callback_query->data, 'add'))->first();

        $old_cart = Cart::where('catalog_id', ltrim($callback_query->data, 'add'))->first();

        if ($old_cart != null) {
            $old_cart->update(['amount' => $old_cart->amount + 1]);
        } else {
            $cart = new Cart;

            $cart->client_id = $client->id;

            $cart->shop_id = $shop->id;

            $cart->catalog_id = $catalog->id;

            $cart->amount = 1;

            $cart->save();
        }
        $bot->answerCallbackQuery([
            'callback_query_id' => $callback_query->id,
            'text' => 'Корзина обновлена',
            'cache_time' => 1,
        ]);
    }

    private function checkClient($client, $shop_id)
    {
        $old_client = Client::where('username', $client['username'])->first();

        if ($old_client != null) {
            $old_client->touch();
        } else {
            $new_client = new Client;

            $new_client->telegram_id = $client->id;
            $new_client->first_name = $client->first_name;
            $new_client->last_name = $client->last_name;
            $new_client->username = $client->username;
            $new_client->shop_id = $shop_id;

            $new_client->save();
        }
    }

    private function newOrder($bot, $shop, $client, $chat_id) {
        $client = Client::where('username', $client['username'])->first();

        if ($client->phone == null || $client->address == null ) {
            $this->updateClient($bot, $shop, $client, $chat_id, ['phone', 'address', 'delivery'], null);
        }
    }

    public function mailing(Request $request)
    {
        $users = User::all();

        $bot = new Api('5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0');

        foreach ($users as $user) {
            $bot->sendMessage([
                'chat_id' => $user->telegram_id,
                'parse_mode' => 'HTML',
                'text' => $request->text,
            ]);
        }

        return redirect()->back();
    }
}

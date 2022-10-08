<?php

namespace App\Http\Controllers;

use App\Client;
use App\Subscriber;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class SpecialBotController extends Controller
{
    public function index($token)
    {
        $bot = new Api($token);

        $updates = $bot->getWebhookUpdates();

        $message = last($updates);

        if (isset($message['message'])) {
            $client = $message['message']['chat'];

        } else {
            $client = $message['callback_query']['from'];
        }

        $this->checkMessage($bot, $message);
    }
    public function longpull()
    {
        $bot = new Api('5451416059:AAEdKASU3cksZ67ra6eR6ZRIFgjiFb9xWVk');

        $response = $bot->getUpdates();

        $message = last($response);



        if (isset($message['message'])) {
            $client = $message['message']['chat'];

        } elseif (isset($message['callback_query'])) {
            $client = $message['callback_query']['from'];
        } else {
            return 'error';
        }

        $this->checkMessage($bot, $message);
    }
    private function checkMessage($bot, $message)
    {

        if (isset($message['callback_query'])) {
            $this->checkCallback($bot, $message);
        } elseif (isset($message['message'])) {
            $client = $message['message']['chat'];

            $message_text = $message['message']['text'];
            $chat_id = $message['message']['chat']['id'];
            $this->checkClient($client, $bot, $message['message'], $chat_id);
            switch ($message_text) {
                case '🏠':
                case '🏠 Главное меню':
                case '/start':
                    $this->sendStartMessage($bot, $chat_id);
                    break;
            }
        }
    }
    private function checkCallback($bot, $message)
    {
        $callback_query = $message['callback_query'];

        $chat_id = $callback_query['message']['chat']['id'];

        $client = $callback_query['from'];

        $message_id = $callback_query['message']['message_id'];

        $data = $callback_query['data'];
        $this->checkClient($client, $bot, $callback_query, $chat_id);
        $subscriber = Subscriber::where('username', $client['username'])->first();
        if (strpos($data, 'sendMore') === 0) {
            $this->sendMore($bot, $chat_id);
        } elseif (strpos($data, 'sendAdvantage') === 0) {
            $this->sendAdvantage($bot, $chat_id);
        } elseif (strpos($data, 'sendName') === 0) {
            $this->sendName($bot, $subscriber, $chat_id);
        }
    }
    private function sendStartMessage($bot, $chat_id)
    {
        $data = [
            [Keyboard::inlineButton(['callback_data' => 'sendMore', 'text' => 'Подробнее'])]
        ];

        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendPhoto([
            'chat_id' => $chat_id,
            'photo' => new InputFile('https://chipbot.ru/images/special.jpg'),
            'caption' => 'Инструмен для продвижения ваших услуг или товаров. Продукт для ваших клиентов, который позволит открыть новые каналы продаж.',
            'reply_markup' => $keyboard,
        ]);
    }

    private function sendMore($bot, $chat_id) {
        $data = [

                [Keyboard::inlineButton(['text' => 'Наш сайт', 'url' => 'https://chipbot.ru/'])],
                [Keyboard::inlineButton(['callback_data' => 'sendAdvantage', 'text' => 'Преимущества'])],


                [Keyboard::inlineButton(['callback_data' => 'sendName', 'text' => 'Попробовать'])],

        ];
        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendPhoto([
            'chat_id' => $chat_id,
            'photo' => new InputFile('https://chipbot.ru/images/special.jpg'),
            'caption' => 'Сервис, в котором за 5-10 минут вы создадите каталог услуг или магазин. Принимайте заяки, оплату: всё в одном сервисе.',
            'reply_markup' => $keyboard,
        ]);
    }
    private function sendAdvantage($bot, $chat_id) {
        $data = [
            [Keyboard::inlineButton(['callback_data' => 'sendName', 'text' => 'Попробовать'])],
        ];

        $keyboard = $this->makeInlineKeyboard($data);

        $bot->sendPhoto([
            'chat_id' => $chat_id,
            'photo' => new InputFile('https://chipbot.ru/images/special.jpg'),
            'caption' => 'Быстрая регистрация. Удобная панель управления настройками. Получай завки и заказы в одном сервисе.',
            'reply_markup' => $keyboard,
        ]);
    }
    private function sendName($bot, $client, $chat_id)
    {
        $data = [];
        $reply_markup = $this->makeKeyboard($data);
        $client->update(['session_id' => 'name']);
        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Оставьте свои контактные данные (имя, телефон или ник)',
            'reply_markup' => $reply_markup,
        ]);
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
            'one_time_keyboard' => true,
        ]);

        return $reply_markup;
    }
    private function checkClient($client, $bot, $message, $chat_id)
    {
        $old_client = Subscriber::where('username', $client['username'])->first();

        if ($old_client != null) {
            $old_client->touch();

            if ($old_client->session_id == 'name') {
                $old_client->update(['contacts' => $message['text']]);

                $bot->sendMessage([
                    'chat_id' => $chat_id,
                    'text' => 'Спасибо, в ближайшее время с вами свяжется оператор.',
                ]);
            }
            $old_client->update(['session_id' => null]);
        } else {
            $new_client = new Subscriber;

            $new_client->telegram_id = $client['id'];
            $new_client->username = $client['username'];

            $new_client->save();
        }
    }

}

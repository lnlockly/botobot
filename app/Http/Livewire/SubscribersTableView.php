<?php

namespace App\Http\Livewire;

use App\Subscriber;
use LaravelViews\Views\TableView;

class SubscribersTableView extends TableView
{
    protected $model = Subscriber::class;
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['Id', 'Username', 'Контакты', 'Первое обращение', 'Последнее обращение'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->telegram_id,
            $model->username,
            $model->contacts,
            $model->created_at,
            $model->updated_at,
        ];
    }

}

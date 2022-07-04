<?php

namespace App\Http\Livewire;

use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\UI;
use App\Order;

class OrdersTableView extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Order::query()->where('shop_id', auth()->user()->current_shop->id);
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['Имя клиента', 'Номер', 'Адрес', 'Доставка', 'Товар', 'Количество', 'Общая стоимость', 'Активен',];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->client->first_name,
            $model->client->phone,
            $model->client->address,
            $model->client->delivery,
            $model->product->name,
            $model->amount,
            $model->amount * $model->product->price,
            UI::editable($model, 'active'),
        ];
    }

    public function update(Order $order, $data)
    {
        $order->update($data);
    }
}

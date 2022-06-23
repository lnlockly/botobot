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
        return Order::query()->where('shop_id', auth()->user()->shop->id);
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['Товар', 'Активен', 'Количество', 'Общая стоимость'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->product->name,
            UI::editable($model, 'active'),
            $model->amount,
            $model->amount * $model->product->price
        ];
    }

    public function update(Order $order, $data)
    {   
        $order->update($data);
    }
}

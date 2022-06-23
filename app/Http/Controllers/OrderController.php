<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;

class OrderController extends Controller
{
    public function index() {
        $user = auth()->user();

        $orders = $user->shop->orders;

        $clients = $orders->groupBy('username');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Catalog;
use App\Client;
use App\Order;

class Shop extends Model
{
	
    public function catalogs() {
    	return $this->hasMany(Catalog::class);
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;

class Client extends Model
{
   public function cart() {
        return $this->hasMany(Cart::class);
   }
}

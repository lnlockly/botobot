<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        'name', 'active', 'section1', 'vendor_code' , 'name' , 'description' , 'weight' , 'volume' , 'diameter' , 'size' , 'color' , 'price' , 'img' , 'url', 'shop_id'
    ];
}

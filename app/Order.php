<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function product() {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }
}

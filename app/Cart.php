<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Catalog;

class Cart extends Model
{
    protected $guarded = [];

    public function product() {
       return $this->belongsTo(Catalog::class, 'catalog_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Catalog;

class Shop extends Model
{
	
    public function catalogs() {
    	return $this->hasMany(Catalog::class);
    }
}

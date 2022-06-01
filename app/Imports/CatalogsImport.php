<?php

namespace App\Imports;

use App\Catalog;
use Maatwebsite\Excel\Concerns\ToModel;

class CatalogsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!array_filter($row)) { return null;}
        $shop = auth()->user()->shop;
        return new Catalog([
            'active' => $row[0],
            'section1' => $row[1],
            'vendor_code' => $row[2],
            'name' => $row[3],
            'description' => $row[4],
            'weight' => $row[5],
            'volume' => $row[6],
            'diameter' => $row[7],
            'size' => $row[8],
            'color' => $row[9],
            'price' => $row[10],
            'img' => $row[11],
            'url' => $row[12],
            'shop_id' => $shop->id
        ]);
    }
}

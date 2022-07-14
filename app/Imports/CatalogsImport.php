<?php

namespace App\Imports;

use App\Catalog;
use App\Http\Requests\StoreCatalogRequest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CatalogsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

        if(!array_filter($row)) { return null;}
        $shop = auth()->user()->current_shop;
        return new Catalog([
            'active' => 1,
            'section1' => $row['razdel'],
            'name' => $row['nazvanie'],
            'description' => $row['opisanie'],
            'price' => $row['cena'],
            'img' => $row['izobrazenie'],
            'url' => $row['ssylka_na_tovar'],
            'shop_id' => $shop->id
        ]);
    }


    public function rules(StoreCatalogRequest $request): array
    {
        return $request;
    }
}

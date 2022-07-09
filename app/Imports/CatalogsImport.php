<?php

namespace App\Imports;

use App\Catalog;
use App\Http\Requests\StoreCatalogRequest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CatalogsImport implements ToModel, WithStartRow
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
            'section1' => $row['раздел'],
            'name' => $row['название'],
            'description' => $row['описание'],
            'price' => $row['цена'],
            'img' => $row['изображение'],
            'url' => $row['ссылка_на_товар'],
            'shop_id' => $shop->id
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }

    public function rules(StoreCatalogRequest $request): array
    {
        return $request;
    }
}

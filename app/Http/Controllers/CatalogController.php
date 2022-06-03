<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Catalog;
use App\Imports\CatalogsImport;

class CatalogController extends Controller
{

	public function save(Request $request) {
		$catalog = new Catalog;

		$catalog->save();

		return redirect()->back();
	}

    public function import(Request $request) {
    	$catalog = new Catalog;
 
    	Excel::import(new CatalogsImport, storage_path('app/public/table.xlsx'));
    	return redirect()->back();

    }
}

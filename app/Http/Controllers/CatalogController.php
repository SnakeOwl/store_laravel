<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Parameter;
use App\Models\Directory;

class CatalogController extends Controller
{
    /**
    * Для каталога.
    *
    * alias - Текущий подраздел каталога (например glasses). Пустая строка, если в корне.
    */
    public function index()
    {
        return view('catalog.index', [
            'items' => Item::all(),
            'aliases' => Directory::all()
        ]);
    }

    public function detail($directory_alias, $item_alias)
    {
        $item = Item::where('alias', $item_alias)->firstOrFail();
        return view('catalog.detail', compact('item'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\ItemsFilterRequest;

class CatalogController extends Controller
{

    public function index(ItemsFilterRequest $request, $category_id = null)
    {
        $item_query = Item::with('category');
        $current_category = false;
        if($request->filled('search'))
        {
            //либо работает поисковик
            $item_query->where('name', 'LIKE', '%' . $request->search . '%');

        }
        else
        {
            //либо фильтр
            if (isset($category_id))
            {
                // фильтр по ссылке (кнопочке)
                $item_query->where('category_id', $category_id);
                $current_category = $category_id;
            }
            elseif ($request->has('category_id'))
            {
                // если происходит поик по цене и фильтр по ссылке нужно сохранить
                $item_query->where('category_id', $request->category_id);
                $current_category = $request->category_id;
            }

            if ($request->filled('price_from'))
            {
                $item_query->where('price', '>=', $request->price_from);
            }

            if ($request->filled('price_to'))
            {
                $item_query->where('price', '<=', $request->price_to);
            }

            foreach(['hit', 'new'] as $field)
            {
                if($request->has($field))
                {
                    $item_query->$field();
                }
            }
        }

        $items = $item_query->simplePaginate(12)->withPath('?' . $request->getQueryString());

        return view('catalog.index', [
            'current_category'=> ($current_category != false)?$current_category : null,
            'items' => $items,
            'search' => ($request->filled('search'))? $request->search : null,
            'aliases' => Category::all()
        ]);
    }

    /**
    * Для каталога.
    *
    * alias - Текущий подраздел каталога (например glasses). Пустая строка, если в корне.
    */
    public function show($category_alias, $item_alias)
    {
        $item = Item::where('alias', $item_alias)->firstOrFail();
        return view('catalog.show', compact('item'));
    }
}

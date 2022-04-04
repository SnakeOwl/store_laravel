<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Item;

class Mini_catalog_v1 extends Component
{
    public $items; // Товары для отображения

    public function __construct()
    {
        $this->items = Item::where("amount", ">", 7)
                        ->take(10)->get();
    }

    public function render()
    {
        return view('components.mini_catalog_v1');
    }
}

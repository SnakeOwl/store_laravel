<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    public function show_home_page()
    {

        return view('home'/*, [
            'item_id_for_single_show' => Item::firstWhere('showed_in_main_slider', 1)->id
        ]*/);
    }
}

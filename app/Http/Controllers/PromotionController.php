<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function show_all()
    {
        return view('admin.promotions', ['data' => ['Заглушка']]);
    }
}

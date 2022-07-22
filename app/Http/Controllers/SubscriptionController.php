<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function store(StoreSubscriptionRequest $request)
    {
        Subscription::create($request->all());
        session()->flash('info', 'Вы были подписаны на рассылку, мы вас оповестим при поступлении товара');

        return redirect()->back();
    }
}

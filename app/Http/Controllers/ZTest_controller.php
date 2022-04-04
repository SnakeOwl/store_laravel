<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ZTest_controller extends Controller
{
    public function test_submit(Request $request)
    {
        //dd($request);
        $path = $request->file('image')->store('images');
        $params = $request->all();
        $params['image'] = $path;
        //Order::create($params)

        // для удаления:
        /*
        Storage::delete($path);
        */
        session()->flash('path', $path);
        //dump($path);
        return redirect()->route('test');
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Storage;

class Storages_list_v1 extends Component
{
    public $storages;
    public function __construct()
    {
        $this->storages = Storage::all();
    }

    public function render()
    {
        return view('components.storages_list_v1', ['storages' => $this->storages]);
    }
}

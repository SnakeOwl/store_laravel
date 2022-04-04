<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_has_Promotion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "order_has_promotions";
}

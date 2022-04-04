<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'city',
        'active'
    ];

    protected $table = "couriers";
}

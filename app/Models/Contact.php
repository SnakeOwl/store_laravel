<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    protected $fillable = [
        'name',
        'email',
        'message',
        'active'
    ];

    protected $table = "contacts";
}

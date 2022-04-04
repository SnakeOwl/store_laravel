<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "items";

    protected $fillable = [
        'name',
        'alias',
        'price',
        'describ',
        'short_image',
        'amount',
        'discont',
        'directory_id'
    ];

    public function get_price_for_amount()
    {
        if (!is_null ($this->pivot))
        {
            return $this->price * $this->pivot->amount;
        }
        return $this->price;
    }

    public function get_description()
    {
        return stripslashes($this->describ);
    }


    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }

    public function images()
    {
        return $this->hasMany(Galery::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function directory()
    {
        return $this->hasOne(Directory::class, 'id', 'directory_id');
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'discont' => '0'
    ];
}

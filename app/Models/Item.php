<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'alias',
        'price',
        'description',
        'short_image',
        'amount',
        'discount',
        'category_id',
        'new',
        'hit'
    ];

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }
    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function is_available()
    {
        return ($this->amount > 0) && (! $this->trashed()) ;
    }

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
        return nl2br($this->description);
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

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'hit' => '0',
        'new' => '0'
    ];
}

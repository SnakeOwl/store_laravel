<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $fillable = [
        'payment_status',
        'status',
        'payment_method',
        'delivery_method',
        'address',
        'post_index',
        'phone',
        'name',
        'storage_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('basket_status', 1);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('amount')->withTimestamps();
    }

    // return full cost of the current order
    public function get_full_cost()
    {
        $sum = 0;

        foreach ($this->items as $item)
        {
            $sum += $item->get_cost_for_amount();
        }

        return $sum;
    }

    public function save_order()
    {
        $this->cost            = $this->get_full_cost();
        $this->basket_status    = 1;
        $this->save();

        session()->forget('order_id');

        return true;
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'Обрабатывается',
        'payment_status' => 0,
        'payment_method' => 'Способ оплаты не выбран',
        'delivery_method' => 'Способ доставки не выбран',
        'address' => 'Адрес не задан',
        'phone' => 'Телефон не задан',
        'cost' => '0'
    ];
}

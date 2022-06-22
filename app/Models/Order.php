<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $fillable = [
        'payment_status',
        'status'
    ];

    public $timestamps = false;
    protected $table = "orders";

    public function scopeActive($query)
    {
        return $query->where('basket_status', 1);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('amount')->withTimestamps();
    }

    public function get_full_price()
    {
        $sum = 0;

        foreach ($this->items as $item)
        {
            $sum += $item->get_price_for_amount();
        }

        return $sum;
    }

    public function save_order( $payment_method,
                                $delivery_method,
                                $address,
                                $post_index,
                                $phone,
                                $name,
                                $storage_id)
    {
        date_default_timezone_set("Europe/Moscow");

        $this->payment_method   = $payment_method;
        $this->delivery_method  = $delivery_method;
        $this->address          = $address;
        $this->post_index       = $post_index;
        $this->phone            = $phone;
        $this->name             = $name;
        $this->price            = $this->get_full_price();
        $this->basket_status    = 1;
        $this->date_created     = date('Y-m-d H:i:s'); 	//Europe/Minsk
        $this->storage_id       = $storage_id;
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
        'price' => '0'
    ];
}

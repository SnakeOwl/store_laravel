<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSubscriptionMessage;


class Subscription extends Model
{
    use HasFactory;

    protected $fillable =['email', 'item_id'];

    public function scopeByItemId($query, $item_id)
    {
        return $query->where('item_id', $item_id);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }

    public static function send_email_to_subscriptions (Item $item)
    {
        $subscriptions = self::byItemId($item->id)->get();

        foreach ($subscriptions as $sub)
        {
            Mail::to($sub->email)->send(new SendSubscriptionMessage($item));
            $sub->status = 1;
            $sub->save();
        }
    }
}

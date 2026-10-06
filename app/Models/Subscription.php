<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'month',
        'month_label',
        'due_date',
        'status',
        'payment_date',
        'receiver',
    ];

    /**
     * Relation: Subscription belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
{
    return $this->hasOneThrough(
        Member::class,
        User::class,
        'id',        // users.id
        'user_id',   // members.user_id
        'user_id',   // subscriptions.user_id
        'id'         // users.id
    );
}

}

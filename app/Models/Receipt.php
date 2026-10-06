<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Receipt extends Model
{
    protected $fillable = [
        'user_id',
        'member_id',
        'receipt_no',
        'payment_date',
        'months',
        'monthly_amount',
        'total_amount',
        'paid_months',
        'pdf_file',
        'receipt_link',
        'receiver'
    ];

    // =========================
    // RELATION: Receipt → User
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
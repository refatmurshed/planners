<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'user_id',
        'member_code',
        'joining_date',
    ];

    /**
     * Relation: Member belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

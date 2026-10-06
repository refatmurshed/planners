<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCosting extends Model
{
    protected $fillable = [
        'event_id',
        'date',
        'amount',
        'description',
        'file',
        'status'
    ];

    /**
     * Relationship: Costing belongs to Event
     */
    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    'name',
    'description',
    'event_date',
    'last_registration_date',
    'min_fee',
    'image',
];

public function registrations()
{
    return $this->hasMany(EventRegistration::class);
}
public function costings()
{
    return $this->hasMany(\App\Models\EventCosting::class);
}
public function sponsors()
{
    return $this->hasMany(\App\Models\Sponsor::class, 'event_id');
}




}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'meetingplace',
        'address',
        'city',
        'googlemapslink',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'max_persons',
        'img_url',

    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

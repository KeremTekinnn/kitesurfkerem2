<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'instructor_id',
        'location_id',
        'course_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'duo_name',
        'duo_email',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}


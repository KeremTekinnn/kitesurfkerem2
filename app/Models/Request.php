<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'new_date',
        'new_start_time',
        'new_end_time',
        'reason',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

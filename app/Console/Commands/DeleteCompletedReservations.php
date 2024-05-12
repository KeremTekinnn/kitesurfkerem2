<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class DeleteCompletedReservations extends Command
{
    protected $signature = 'delete-completed-reservations';

    protected $description = 'Command description';


    public function handle()
    {
        Reservation::whereRaw("CONCAT(date, ' ', end_time) < ?", [Carbon::now()])->delete();
    }
}

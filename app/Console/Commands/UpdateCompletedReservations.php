<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class UpdateCompletedReservations extends Command
{
    protected $signature = 'update-completed-reservations';

    protected $description = 'Command update';

    public function handle()
    {
        Reservation::where('end_time', '<', Carbon::now())
                   ->where('status', '!=', 'completed')
                   ->update(['status' => 'completed']);
    }
}

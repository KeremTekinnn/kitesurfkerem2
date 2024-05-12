<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::create([
            'reservation_id' => 1,
            'new_date' => '2024-05-16',
            'new_start_time' => '08:00:00',
            'new_end_time' => '10:30:00',
            'reason' => 'Ik heb een afspraak',
        ]);
        Request::create([
            'reservation_id' => 2,
            'new_date' => '2024-05-18',
            'new_start_time' => '08:00:00',
            'new_end_time' => '10:30:00',
            'reason' => 'Vertraging',
        ]);
    }
}

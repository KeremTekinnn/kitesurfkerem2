<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
            'client_id' => 7,
            'instructor_id' => 2,
            'location_id' => 1,
            'course_id' => 1,
            'date' => '2024-05-14',
            'start_time' => '08:00:00',
            'end_time' => '11:30:00',
            'status' => 'booked',
        ]);
        Reservation::create([
            'client_id' => 7,
            'instructor_id' => 2,
            'location_id' => 1,
            'course_id' => 2,
            'duo_name' => 'John Doe',
            'duo_email' => 'johndoe@gmail.com',
            'date' => '2024-05-16',
            'start_time' => '08:00:00',
            'end_time' => '10:30:00',
            'status' => 'booked',
        ]);
        Reservation::create([
            'client_id' => 7,
            'instructor_id' => 2,
            'location_id' => 1,
            'course_id' => 2,
            'duo_name' => 'John Doe',
            'duo_email' => 'abi@gmail.com',
            'date' => '2024-05-17',
            'start_time' => '08:00:00',
            'end_time' => '10:30:00',
            'status' => 'booked',
        ]);
        Reservation::create([
            'client_id' => 7,
            'instructor_id' => 2,
            'location_id' => 1,
            'course_id' => 2,
            'duo_name' => 'John Doe',
            'duo_email' => 'anan@gmail.com',
            'date' => '2024-05-18',
            'start_time' => '08:00:00',
            'end_time' => '10:30:00',
            'status' => 'booked',
        ]);
    }
}

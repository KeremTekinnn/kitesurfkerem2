<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(RequestSeeder::class);
    }
}

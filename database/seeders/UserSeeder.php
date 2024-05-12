<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Terence Olieslager',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // replace 'password' with the admin's real password
                'role' => 'admin',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Duco Veenstra',
                'email' => 'instructor@example.com',
                'password' => bcrypt('password'), // replace 'password' with the instructor's real password
                'role' => 'instructor',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Waldemar van Dongen',
                'email' => 'vandongen@example.com',
                'password' => bcrypt('password'), // replace 'password' with the instructor's real password
                'role' => 'instructor',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Ruud Terlingen',
                'email' => 'terlingen@example.com',
                'password' => bcrypt('password'), // replace 'password' with the instructor's real password
                'role' => 'instructor',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Saskia Brink',
                'email' => 'brink@example.com',
                'password' => bcrypt('password'), // replace 'password' with the instructor's real password
                'role' => 'instructor',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Bernie Vredenstein',
                'email' => 'vredenstein@example.com',
                'password' => bcrypt('password'), // replace 'password' with the instructor's real password
                'role' => 'instructor',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Client User',
                'email' => 'client@example.com',
                'password' => bcrypt('password'), // replace 'password' with the client's real password
                'role' => 'client',
                'address' => 'Schorpioenstraat 67',
                'residence' => 'Rotterdam',
                'birthdate' => '1980-01-01',
                'mobile' => '0612345678',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Client User',
                'email' => 'client2@example.com',
                'password' => bcrypt('password'), // replace 'password' with the client's real password
                'role' => 'client',
                'address' => 'Schorpioenstraat 67',
                'residence' => 'Rotterdam',
                'birthdate' => '1980-01-01',
                'mobile' => '0612345678',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Client User',
                'email' => 'client3@example.com',
                'password' => bcrypt('password'), // replace 'password' with the client's real password
                'role' => 'client',
                'address' => 'Schorpioenstraat 67',
                'residence' => 'Rotterdam',
                'birthdate' => '1980-01-01',
                'mobile' => '0612345678',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Client User',
                'email' => 'client4@example.com',
                'password' => bcrypt('password'), // replace 'password' with the client's real password
                'role' => 'client',
                'address' => 'Schorpioenstraat 67',
                'residence' => 'Rotterdam',
                'birthdate' => '1980-01-01',
                'mobile' => '0612345678',
                'email_verified_at' => now(),

            ],
            [
                'name' => 'Client User',
                'email' => 'client5@example.com',
                'password' => bcrypt('password'), // replace 'password' with the client's real password
                'role' => 'client',
                'address' => 'Schorpioenstraat 67',
                'residence' => 'Rotterdam',
                'birthdate' => '1980-01-01',
                'mobile' => '0612345678',
                'email_verified_at' => now(),

            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('courses')->insert(
            [
                [
                    'name' => 'Kitesurfen Privéles 2,5 uur',
                    'description' => 'Leer kitesurfen',
                    'price' => 175,
                    'max_persons' => 1,
                    'duration' => 2.5,
                    'img_url' => 'img/item1.jpg'
                ],
                [
                    'name' => 'Losse Duo Kiteles 3,5 uur',
                    'description' => 'Leer samen kitesurfen',
                    'price' => 135,
                    'max_persons' => 2,
                    'duration' => 3.5,
                    'img_url' => 'img/item2.jpg'
                ],
                [
                    'name' => 'Kitesurf Duo lespakket 3 lessen 10,5 uur',
                    'description' => 'Leer samen kitesurfen',
                    'price' => 375,
                    'max_persons' => 2,
                    'duration' => 2.5,
                    'img_url' => 'img/item3.jpg'
                ],
                [
                    'name' => 'Kitesurf Duo lespakket 5 lessen 17,5 uur',
                    'description' => 'Leer samen kitesurfen',
                    'price' => 675,
                    'max_persons' => 2,
                    'duration' => 3.5,
                    'img_url' => 'img/item4.jpg'
                ],
            ]
        );
    }
}

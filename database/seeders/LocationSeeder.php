<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'meetingplace' => 'Laguna Beach Club',
                'address' => 'Strandweg 8',
                'city' => 'Zandvoort',
                'googlemapslink' => 'https://www.google.com/maps/dir//Strandweg+8,+2042+JA+Zandvoort/@52.3721598,4.441472,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x47c5ed25456705d7:0xa9ab2b0dbde8aae6!2m2!1d4.5238722!2d52.3721885?entry=ttu',
            ],
            [
                'meetingplace' => 'Strandpaviljoen De Zeemeeuw',
                'address' => 'Palviljoenweg 51',
                'city' => 'Muiderverg',
                'googlemapslink' => 'https://www.google.com/maps/place/Strandpaviljoen+De+Zeemeeuw+-+Restaurant+Muiderberg/@52.3294645,5.1191656,17z/data=!3m1!4b1!4m6!3m5!1s0x47c6122ee86a9c39:0x8cebc4ab012b81cf!8m2!3d52.3294645!4d5.1191656!16s%2Fg%2F1tfh3w1b?entry=ttu',
            ],
            [
                'meetingplace' => 'BEACHCLUB SUNSEA',
                'address' => 'Zandweg 102',
                'city' => 'Wijk aan zee',
                'googlemapslink' => 'https://www.google.com/maps?hl=nl&gl=nl&um=1&ie=UTF-8&fb=1&sa=X&ftid=0x47c5f1715ccbf441:0xffdc8c660c63dc8',
            ],
            [
                'meetingplace' => 'Zandkasteel club',
                'address' => 'Hobbellaan 100',
                'city' => 'Scheveningen',
                'googlemapslink' => 'https://www.google.com/maps?hl=nl&gl=nl&um=1&ie=UTF-8&fb=1&sa=X&ftid=0x47c5f1715ccbf441:0xffdc8c660c63dc8',
            ],
            [
                'meetingplace' => 'Aloha club',
                'address' => 'strandweg 1',
                'city' => 'Hoekvanholland',
                'googlemapslink' => 'https://www.google.com/maps?hl=nl&gl=nl&um=1&ie=UTF-8&fb=1&sa=X&ftid=0x47c5f1715ccbf441:0xffdc8c660c63dc8',
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}

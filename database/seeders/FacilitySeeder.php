<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'WiFi',
            'AC',
            'Kamar Mandi Dalam',
            'Dapur',
            'Parkir Motor',
            'Parkir Mobil',
            'Kasur',
            'Lemari',
            'Meja Belajar',
            'Laundry',
            'CCTV',
        ];

        foreach ($items as $name) {
            Facility::firstOrCreate(['name' => $name]);
        }
    }
}

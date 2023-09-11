<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resto_id = Restaurant::where('name', 'Amani')->first()->id;
        $staffs = [
            [
                'restaurant_id' => $resto_id,
                'name' => 'Gregory Change',
                'fonction' => 'Chef Cuisinier',
                'image' => '/uploads/seeders/staff/gregory_chang.jpg',

            ],
            [
                'restaurant_id' => $resto_id,
                'name' => 'Guy Samba',
                'fonction' => 'Chef Cuisinier',
                'image' => '/uploads/seeders/staff/guy_samba.jpg',

            ],
            [
                'restaurant_id' => $resto_id,
                'name' => 'Alice Simonet',
                'fonction' => 'Chef Cuisinier',
                'image' => '/uploads/seeders/staff/alice_simonet.jpg',

            ],
            [
                'restaurant_id' => $resto_id,
                'name' => 'Marie Van Dooren',
                'fonction' => 'Chef Cuisinier',
                'image' => '/uploads/seeders/staff/marie_van_dooren.jpg',

            ],
            [
                'restaurant_id' => $resto_id,
                'name' => 'Mourad Meghni',
                'fonction' => 'Chef Cuisinier',
                'image' => '/uploads/seeders/staff/mourad_meghni.jpg',

            ],
        ];

        Staff::insert($staffs);
    }
}

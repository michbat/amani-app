<?php

namespace Database\Seeders;

use App\Models\Band;
use App\Models\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cgid = Band::where('name', 'Cool and Gang')->first()->id;
        $jbid = Band::where('name', 'Jah Bless')->first()->id;
        $vaid = Band::where('name', 'Vener Amazones')->first()->id;
        $ylid = Band::where('name', 'Young Leaders')->first()->id;
        $alid = Band::where('name', 'Alegria')->first()->id;
        $dtid = Band::where('name', 'Dream Team')->first()->id;
        $amid = Band::where('name', 'Alabama Mood')->first()->id;
        $majid = Band::where('name', 'Majestic')->first()->id;


        $artists = [

            // Cool and Gang artists

            [
                'band_id' => $cgid,
                'name' => 'MC Mic'
            ],
            [
                'band_id' => $cgid,
                'name' => 'Rythmique Brux'
            ],
            [
                'band_id' => $cgid,
                'name' => 'FlowMan'
            ],
            [
                'band_id' => $cgid,
                'name' => 'Sicko'
            ],
            [
                'band_id' => $cgid,
                'name' => 'Rim D'
            ],

            // Jah Bless Artists

            [
                'band_id' => $jbid,
                'name' => 'Rootsman'
            ],
            [
                'band_id' => $jbid,
                'name' => 'Dubmaster'
            ],
            [
                'band_id' => $jbid,
                'name' => 'Lionheart'
            ],
            [
                'band_id' => $jbid,
                'name' => 'Reggae King'
            ],
            [
                'band_id' => $jbid,
                'name' => 'Irie'
            ],

            // Vener Amazones Artists

            [
                'band_id' => $vaid,
                'name' => 'Furious'
            ],
            [
                'band_id' => $vaid,
                'name' => 'Venom'
            ],
            [
                'band_id' => $vaid,
                'name' => 'FF'
            ],
            [
                'band_id' => $vaid,
                'name' => 'Piranha'
            ],

            // Young Leaders Artists

            [
                'band_id' => $ylid,
                'name' => 'Dylan'
            ],
            [
                'band_id' => $ylid,
                'name' => 'Max'
            ],
            [
                'band_id' => $ylid,
                'name' => 'Ethan'
            ],
            [
                'band_id' => $ylid,
                'name' => 'Mattéo'
            ],
            [
                'band_id' => $ylid,
                'name' => 'Bryan'
            ],

            // Alegria Artists

            [
                'band_id' => $alid,
                'name' => 'Amélie'
            ],
            [
                'band_id' => $alid,
                'name' => 'Pierre'
            ],
            [
                'band_id' => $alid,
                'name' => 'Louis'
            ],
            [
                'band_id' => $alid,
                'name' => 'Chloé'
            ],
            [
                'band_id' => $alid,
                'name' => 'Nicolas'
            ],
            [
                'band_id' => $alid,
                'name' => 'Gégé'
            ],

            // Dream Team Artists

            [
                'band_id' => $dtid,
                'name' => 'Kwamé'
            ],
            [
                'band_id' => $dtid,
                'name' => 'Malik'
            ],
            [
                'band_id' => $dtid,
                'name' => 'Jabari'
            ],
            [
                'band_id' => $dtid,
                'name' => 'Nala'
            ],
            [
                'band_id' => $dtid,
                'name' => 'Wizzy'
            ],
            [
                'band_id' => $dtid,
                'name' => 'Sonny'
            ],

            // Alabama Mood

            [
                'band_id' => $amid,
                'name' => 'Oliver Grooves'
            ],
            [
                'band_id' => $amid,
                'name' => 'Lucas Bluesville'
            ],
            [
                'band_id' => $amid,
                'name' => 'Swingman'
            ],
            [
                'band_id' => $amid,
                'name' => 'Peter Armstrong '
            ],
            [
                'band_id' => $amid,
                'name' => 'Fino'
            ],
            [
                'band_id' => $amid,
                'name' => 'Jacky'
            ],

            // Majestic Artist

            [
                'band_id' => $majid,
                'name' => 'Lena'
            ],
            [
                'band_id' => $majid,
                'name' => 'Max'
            ],
            [
                'band_id' => $majid,
                'name' => 'Louise'
            ],
            [
                'band_id' => $majid,
                'name' => 'Anthony'
            ],



        ];

        Artist::insert($artists);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Band;
use App\Models\Music;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MusicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $musics = [
            [
                'style' => 'Rock'
            ],
            [
                'style' => 'Pop'
            ],
            [
                'style' => 'Pop/Rock'
            ],
            [
                'style' => 'Rap/Hip-Hop'
            ],
            [
                'style' => 'Jazz'
            ],
            [
                'style' => 'Variétés'
            ],
            [
                'style' => 'Reggae/Ska'
            ],
            [
                'style' => 'Afro-Pop'
            ],
        ];

        Music::insert($musics);

        $music_1 = Music::find(1);  // Rock
        $music_2 = Music::find(2);  // Pop
        $music_3 = Music::find(3);   // Pop/Rock
        $music_4 = Music::find(4);   // Rap/Hip-Hop
        $music_5 = Music::find(5);   // Jazz
        $music_6 = Music::find(6);   // Variétés
        $music_7 = Music::find(7);   // Reggae/Ska
        $music_8 = Music::find(8);  // Afro-Pop

        $band_1 = Band::find(1);  // Cool and Gang
        $band_2 = Band::find(2);  // Jah Bless
        $band_3 = Band::find(3);  // Vener Amazones
        $band_4 = Band::find(4); // Young Leaders
        $band_5 = Band::find(5);  // Alegria
        $band_6 = Band::find(6); // Dream Team
        $band_7 = Band::find(7); // Alabama Mood
        $band_8 = Band::find(8); // Majestic


        $band_1->musics()->attach($music_4);
        $band_2->musics()->attach($music_7);
        $band_3->musics()->attach([$music_1->id, $music_3->id]);
        $band_4->musics()->attach($music_2);
        $band_5->musics()->attach($music_6);
        $band_6->musics()->attach([$music_8->id, $music_4->id]);
        $band_7->musics()->attach($music_5);
        $band_8->musics()->attach([$music_1->id, $music_3->id, $music_6->id]);
    }
}

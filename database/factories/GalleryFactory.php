<?php

namespace Database\Factories;

use App\Enums\GalleryType;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = GalleryType::getRandomMediaTypeName();
        return [
            'restaurant_id' => Restaurant::where('name', 'Amani')->first()->id,
            'title' => fake()->unique()->words($nb = 2, $asText = true),
            'image' => ' ',
            'galleryType' => $type,
            'videoId' => $type === 'video' ? 'Un lien vidéo' : '',

        ];
    }
}

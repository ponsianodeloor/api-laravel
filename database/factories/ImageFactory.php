<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl(640, 480, null, true),
            'user_id' => User::all()->random()->id
        ];
    }
}

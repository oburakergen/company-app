<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            "name" => $name,
            "slug" => Str::slug($name),
            "email" => $this->faker->email(),
            "logo" => $this->faker->imageUrl(240,240,"logo"),
            "website" => $this->faker->url(),
        ];
    }
}

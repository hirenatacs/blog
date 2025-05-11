<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TermTaxonomy>
 */
class TermTaxonomyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'term_id' => \App\Models\Term::factory(),
            'taxonomy' => $this->faker->randomElement(['category', 'tag']),
            'description' => $this->faker->sentence,
        ];
    }
}

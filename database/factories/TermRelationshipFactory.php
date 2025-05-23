<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\TermTaxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TermRelationshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'term_taxonomy_id' => TermTaxonomy::factory(),
        ];
    }
}

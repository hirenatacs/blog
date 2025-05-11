<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*\App\Models\User::factory(10)->create()->each(function ($user) {
            \App\Models\Post::factory(3)->create([
                'user_id' => $user->id,
            ]);
        });*/

        \App\Models\User::factory(10)->create()->each(function($user){
            \App\Models\Post::factory(20)
            ->has(\App\Models\PostMeta::factory()->count(2))
            ->create(
                [
                    'user_id' => $user->id,
                ]
            );
        });

        \App\Models\Term::factory(5)->create()->each(function ($term) {
            \App\Models\TermTaxonomy::factory()->create([
                'term_id' => $term->id,
            ]);
        });

        \App\Models\Post::all()->each(function ($post) {
            $taxonomies = \App\Models\TermTaxonomy::inRandomOrder()->take(2)->get();
            foreach ($taxonomies as $taxonomy) {
                \App\Models\TermRelationship::factory()->create([
                    'post_id' => $post->id,
                    'term_taxonomy_id' => $taxonomy->id,
                ]);
            }
        });

        \App\Models\Comment::factory(30)->create();

        \App\Models\Option::factory()->create([
            'option_key' => 'site_title',
            'option_value' => 'Demo Laravel CMS',
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Track;
use App\Models\Code;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create weeks
        $this->call(WeekSeeder::class);

        // Seed categories
        $this->call(CategorySeeder::class);

        // Load all categories
        $categories = Category::all();

        // Ensure there are categories to assign
        if ($categories->isEmpty()) {
            $this->command->error('No categories found, Track seeding aborted!');
            return;
        }

        // Create users with tracks and codes
        User::factory()
            ->count(15)
            ->has(
                Track::factory(config('app.tracks_per_week'))
                    ->state(new Sequence(fn () => [
                        'week_id' => rand(2, 7),
                        'category_id' => $categories->random()->id, // Assign random category
                    ]))
                    ->sample()
            )
            ->has(Code::factory(config('app.codes_count')))
            ->sequence(function (Sequence $sequence) {
                $id = str_pad($sequence->index + 1, 4, "0", STR_PAD_LEFT);
                return ['email' => "user{$id}@example.com"];
            })
            ->create();

        // Update tracks count for each category
        $this->updateTracksCount();
    }

    /**
     * Update tracks count for all categories.
     */
    protected function updateTracksCount(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->tracks_count = Track::where('category_id', $category->id)->count();
            $category->save();
        }
    }
}

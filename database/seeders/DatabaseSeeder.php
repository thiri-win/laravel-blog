<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('pass')
        ]);

        User::factory()->create([
            'name' => 'Thiri Win',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('pass')
        ]);

        User::factory(10)->create();

        Post::factory(30)->create()->each(function ($post) {
            $post->comments()->createMany(Comment::factory(rand(1, 5))->make()->toArray());
            $post->user_id = User::all()->random()->id;
            $post->save();
        });
    }
}

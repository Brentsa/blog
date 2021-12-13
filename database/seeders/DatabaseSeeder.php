<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //clear our User and Category before seeding
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user1 = User::factory()->create([
            'name' => 'John Doe'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Doe'
        ]);

        Post::factory(5)->create([
            'user_id' => $user1->id
        ]);

        Post::factory(5)->create([
            'user_id' => $user2->id
        ]);


        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => "Personal",
        //     'slug' => "personal"
        // ]);

        // $family = Category::create([
        //     'name' => "Family",
        //     'slug' => "family"
        // ]);

        // $work = Category::create([
        //     'name' => "Work",
        //     'slug' => "work"
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post', 
        //     'slug' => 'my-family-post', 
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
        //     'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post', 
        //     'slug' => 'my-work-post', 
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
        //     'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
        // ]);
    }
}

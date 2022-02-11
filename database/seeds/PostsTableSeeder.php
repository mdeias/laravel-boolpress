<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $new_post = new Post();
            $new_post->title = $faker->sentence(2);
            $new_post->content = $faker->text();
            $new_post->slug = Post::generateSlug($new_post->title);
            $new_post->save();
        }
    }
}

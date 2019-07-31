<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::query()->truncate();
        Post::query()->truncate();
        Comment::query()->truncate();

        $users = factory(User::class, 10)->create();

        $users->each(function ($user) {
            $posts = factory(Post::class, random_int(1, 10))->create([
                'user_id' => $user->id,
            ]);

            $posts->each(function ($post) {
                factory(Comment::class, random_int(1, 10))->create([
                    'post_id' => $post->id,
                ]);
            });
        });
    }
}

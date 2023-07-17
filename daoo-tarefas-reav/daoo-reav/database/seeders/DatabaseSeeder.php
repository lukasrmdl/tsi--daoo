<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    
     // \App\Models\User::factory(10)->create();

    //\App\Models\User::factory()->create([
    //    'name' => 'Test User',
    //    'email' => 'test@example.com',
    //]);

    \App\Models\User::factory()->count(20)->hasTopics(2)->hasComments(10)->create();

    //(new UserFactory)->count(20)->create();

    //(new TopicFactory)->count(20)->create();

    //(new CommentFactory)->count(30)->create();
    }
}
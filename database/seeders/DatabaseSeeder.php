<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Tag;
use App\Models\User;
use Faker\Provider\Lorem;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // user create
        User::create ([
            'name' => 'Aung Ko Oo',
            'email' => 'aungkooo@gmail.com',
            'password' => Hash::make('password'),
            'image' => '/images/profile/default.png',
        ]);

        // tag create
        Tag::create([
            'name' => 'Web Developement',
            'slug' => Str::slug('Web Develpoement')
        ]);

         Tag::create([
            'name' => 'Web Design',
            'slug' => Str::slug('Web Design')
        ]);

         Tag::create([
            'name' => 'Android Developement',
            'slug' => Str::slug('Android Develpoement')
        ]);

        // question
        Question::create([
            'user_id' => 1,
            'slug' => Str::slug('Larave 10 not working?'),
            'title' => 'Larave 10 not working?',
            'description' =>'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.',
        ]);

        // question tag
        QuestionTag::create([
            'question_id' => 1,
            'tag_id' => 1,
        ]);
        
        QuestionTag::create([
            'question_id' => 1,
            'tag_id' => 2,
        ]);
    }
}
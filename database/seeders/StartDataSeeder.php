<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StartDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'description' => 'administrator of the system',
            ],
            [
                'name' => 'author',
                'description' => 'author, able to create and edit its own posts',
            ]
        ];

        Role::insert($roles);

        $admin = User::create([
            'name' => 'administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('sgdevsgdev'),
        ]);

        $author = User::create([
            'name' => 'author',
            'email' => 'author@author.com',
            'password' => Hash::make('sgdevsgdev'),
        ]);

        $admin->roles()->attach(1);
        $author->roles()->attach(2);

        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Posts about the latest in technology, gadgets, and software.',
                'parent_id' => null,
                'user_id' => $admin->id
            ],
            [
                'name' => 'Programming',
                'description' => 'Articles related to coding and programming tutorials.',
                'parent_id' => null,
                'user_id' => $admin->id
            ],
            [
                'name' => 'Health & Wellness',
                'description' => 'Tips and advice for a healthy lifestyle.',
                'parent_id' => null,
                'user_id' => $admin->id
            ],
            [
                'name' => 'Fitness',
                'description' => 'Posts about workouts, fitness tips, and maintaining health.',
                'parent_id' => null,
                'user_id' => $admin->id
            ],
        ];

        Category::insert($categories);

        $tags = [
            [
                'name' => 'Laravel',
                'description' => 'Posts related to the Laravel PHP framework.',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'JavaScript',
                'description' => 'All things related to JavaScript programming.',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Vue.js',
                'description' => 'Content about the Vue.js JavaScript framework.',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Web Development',
                'description' => 'Posts focused on web development practices and technologies.',
                'user_id' => $admin->id,
            ],
        ];

        Tag::insert($tags);

    }
}

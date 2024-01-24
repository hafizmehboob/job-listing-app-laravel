<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(5)->create();
        //Listing::factory(6)->create();

        // Create a user and assign 6 job listings to him

        $user = User::factory()->create([
            'name' => 'Jhon Doe',
            'email' => 'Jhon@gmail.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        /*  Listing::create([
            'title' => 'Laravel Dev',
            'tags' => 'Laravel, Jvascript',
            'company' => 'Acme Crop',
            'Location' => 'Boston, Ma',
            'email' => 'email1@email.com',
            'website' => 'https://www.acme.com',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        ]);

        Listing::create([
            'title' => 'Laravel Dev',
            'tags' => 'Laravel, Jvascript',
            'company' => 'Acme Crop',
            'Location' => 'Boston, Ma',
            'email' => 'email1@email.com',
            'website' => 'https://www.acme.com',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        ]); */
    }
}

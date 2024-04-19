<?php

namespace Database\Seeders;

use App\Models\MessageType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $messageTypes = [
            'text',
            'video',
            'photo'
        ];

        foreach ($messageTypes as $type) {
            MessageType::create([
                'name' => $type
            ]);
        }
    }
}

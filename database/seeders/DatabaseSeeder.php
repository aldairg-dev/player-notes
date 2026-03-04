<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            PlayersSeeder::class,
            NotesSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Aldair Gutierrez',
            'email' => 'aldair@example.com',
        ])->assignRole('guest');


        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole('super-admin');
    }
}

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

        User::factory(1)->create([
            'name' => 'Aldair Gutierrez',
            'email' => 'aldair@example.com',
        ])->assignRole('guest');
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\KategoriBisnis;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        KategoriBisnis::create([
            'id' => 1,
            'name' => 'Bisnis Digital'
        ]);
        KategoriBisnis::create([
            'id' => 2,
            'name' => 'Bisnis Makanan'
        ]);
        KategoriBisnis::create([
            'id' => 3,
            'name' => 'Bisnis Properti'
        ]);
        $this->call([
            IndoRegionSeeder::class,
            // ModuleSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            // CattleSeeder::class,
        ]);

    }
}

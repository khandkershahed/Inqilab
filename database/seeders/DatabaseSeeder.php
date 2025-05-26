<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class, // 1st
            RolePermissionSeeder::class, // 2nd
            SettingSeeder::class, // 3rd
            // CategorySeeder::class, // 4th
            // NewsSeeder::class, // 5th
        ]);
        // $this->call(UserSeeder::class);
    }
}

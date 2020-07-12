<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateSuperAdminUserSeeder::class);
        $this->call(HotelsPermissionSeeder::class);
        $this->call(HotelsSeeder::class);
        $this->call(AirlinesPermissionSeeder::class);
        $this->call(AirlinesSeeder::class);
    }
}

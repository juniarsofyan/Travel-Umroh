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
        // $this->call(CreateSuperAdminUserSeeder::class);
        $this->call(HotelsPermissionSeeder::class);
        // $this->call(ProjectAndOfficerSeeder::class);
        // $this->call(ReportByCategorySeeder::class);
        // $this->call(PermissionTableSeeder::class);
    }
}

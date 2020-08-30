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
        $this->call(HotelPermissionSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(MaskapaiPermissionSeeder::class);
        $this->call(MaskapaiSeeder::class);
        $this->call(JenisKamarPermissionSeeder::class);
        $this->call(JenisKamarSeeder::class);
        $this->call(TemplateItineraryPermissionSeeder::class);
        $this->call(PaketUmrohPermissionSeeder::class);
        $this->call(SyncAllPermissionsSeeder::class);
    }
}

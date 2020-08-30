<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class HotelPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Hotel Create',
            'Hotel View',
            'Hotel Update',
            'Hotel Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

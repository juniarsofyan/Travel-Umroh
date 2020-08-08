<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoomsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Rooms Create',
            'Rooms View',
            'Rooms Update',
            'Rooms Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

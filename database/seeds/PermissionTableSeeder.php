<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Role Create',
            'Role View',
            'Role Update',
            'Role Delete',
            'Permission Create',
            'Permission View',
            'Permission Update',
            'Permission Delete',
            'User Create',
            'User View',
            'User Update',
            'User Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

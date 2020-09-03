<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class JamaahPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Jamaah Create',
            'Jamaah View',
            'Jamaah Update',
            'Jamaah Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

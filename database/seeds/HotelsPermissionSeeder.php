<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class HotelsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Hotels Create',
            'Hotels View',
            'Hotels Update',
            'Hotels Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

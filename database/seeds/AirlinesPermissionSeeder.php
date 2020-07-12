<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AirlinesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Airlines Create',
            'Airlines View',
            'Airlines Update',
            'Airlines Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

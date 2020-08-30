<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PaketUmrohPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Paket Umroh Create',
            'Paket Umroh View',
            'Paket Umroh Update',
            'Paket Umroh Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

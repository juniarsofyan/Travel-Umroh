<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class JenisKamarPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Jenis Kamar Create',
            'Jenis Kamar View',
            'Jenis Kamar Update',
            'Jenis Kamar Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class JadwalPenerbanganPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Jadwal Penerbangan Create',
            'Jadwal Penerbangan View',
            'Jadwal Penerbangan Update',
            'Jadwal Penerbangan Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

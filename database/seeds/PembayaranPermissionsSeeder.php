<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PembayaranPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Pembayaran Create',
            'Pembayaran View',
            'Pembayaran Update',
            'Pembayaran Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }        
    }
}

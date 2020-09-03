<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TransaksiPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Transaksi Create',
            'Transaksi View',
            'Transaksi Update',
            'Transaksi Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

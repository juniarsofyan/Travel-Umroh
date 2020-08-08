<?php

use Illuminate\Database\Seeder;
use App\Room;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SyncAllPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $allPermissions = Permission::pluck('id', 'id')->all();

        $superAdminRole->syncPermissions($allPermissions);
    }
}

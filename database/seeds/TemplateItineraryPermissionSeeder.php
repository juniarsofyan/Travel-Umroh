<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TemplateItineraryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Template Itinerary Create',
            'Template Itinerary View',
            'Template Itinerary Update',
            'Template Itinerary Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crud = ['create','read','update','delete'];
        $models = [
            'companies','plans','employees',
            'support-systems','departments',
            'blacklist','skills','agreements',
            'contact-us','settings','languages',
            'admins'
        ];

        foreach ($models as $model) {
            foreach ($crud as $ssd) {
                $name = $ssd."_".$model;
                Permission::create(['guard_name' => 'admin','name' => $name]);
            }
        }

        $admin = Admin::first();
        $permissions = Permission::all();
        $admin->givePermissionTo($permissions);
    }
}

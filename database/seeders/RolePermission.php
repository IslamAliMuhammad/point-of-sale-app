<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $roles = Role::all();
        $permissions = Permission::all();

        // admin => read
        $roles[1]->givePermissionTo($permissions[1]);
    }
}

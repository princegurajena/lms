<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'apply']);
        Permission::create(['name' => 'recommend']);
        Permission::create(['name' => 'reject']);
        Permission::create(['name' => 'close']);
        Permission::create(['name' => 'authorize']);
        Permission::create(['name' => 'view hr statistics']);
        Permission::create(['name' => 'view department statistics']);
        Permission::create(['name' => 'exec view']);
        Permission::create(['name' => 'exec recommend']);
        Permission::create(['name' => 'exec authorize']);
        Permission::create(['name' => 'exec reject']);
        Permission::create(['name' => 'exec close']);
        Permission::create(['name' => 'view employees']);
        Permission::create(['name' => 'edit employee details']);
        Permission::create(['name' => 'reset passwords']);

        Role::create(['name' => 'General'])->givePermissionTo(['view','apply','close']);
        Role::create(['name' => 'Supervisor'])->givePermissionTo(['recommend','reject','close','apply','view department statistics','view employees','edit employee details']);
        Role::create(['name' => 'Human Resources'])->givePermissionTo(['authorize','view hr statistics','apply','close','view employees','edit employee details','reset passwords']);
        Role::create(['name' => 'Head Of Department'])->givePermissionTo(['authorize','reject','close','apply','view department statistics','view employees','edit employee details']);
        Role::create(['name' => 'Executive Supervisor'])->givePermissionTo(['exec recommend','apply','view department statistics','view employees','edit employee details','exec close']);
        Role::create(['name' => 'Executive Human Resources'])->givePermissionTo(['exec authorize','view department statistics','apply','view employees','edit employee details','exec close']);
        Role::create(['name' => 'System Administrator'])->givePermissionTo(Permission::all());

    }
}

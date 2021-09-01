<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            //DB::beginTransaction();

            // Reset cached roles and permissions
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions
            Permission::create(['name' => 'System User Management']);
            Permission::create(['name' => 'Role Management']);
            Permission::create(['name' => 'Product Management']);
            Permission::create(['name' => 'Invoice Management']);
            Permission::create(['name' => 'Sell Management']);
            Permission::create(['name' => 'Settings']);
            Permission::create(['name' => 'Company Management']);
            Permission::create(['name' => 'Report Manager']);
            Permission::create(['name' => 'Expense Category']);
            Permission::create(['name' => 'Expense Management']);
            Permission::create(['name' => 'Customer Management']);
            Permission::create(['name' => 'Customer Due Management']);
            Permission::create(['name' => 'Loan Management']);

            $role1 = Role::create(['name' => 'Super Admin']);
            $role1->givePermissionTo('System User Management');
            $role1->givePermissionTo('Role Management');
            $role1->givePermissionTo('Product Management');
            $role1->givePermissionTo('Invoice Management');
            $role1->givePermissionTo('Sell Management');
            $role1->givePermissionTo('Settings');
            $role1->givePermissionTo('Company Management');
            $role1->givePermissionTo('Report Manager');
            $role1->givePermissionTo('Expense Category');
            $role1->givePermissionTo('Expense Management');
            $role1->givePermissionTo('Customer Management');
            $role1->givePermissionTo('Customer Due Management');
            $role1->givePermissionTo('Loan Management');

            $user = App\User::create([
                'name' => 'Super Admin',
                'mobile_no'=>'01675923371',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'type'=>'system',
                'created_at'=>Carbon::now()
            ]);

            $user->assignRole($role1);

            //DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }
}

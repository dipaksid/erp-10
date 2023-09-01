<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'ADMINISTRATOR')->first();
        $permissions = Permission::get();
        $role->syncPermissions($permissions);
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);  //Assign permission to role
        }
        $employee = User::create([
            'name' => 'Stanley',
            'email' => 'stanley@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$xCTaraCOuU4qeO0irnuWkup3zuHVdKTYFQ.w4qzGC4DOAn4TT5VsK', //123123123
            'remember_token' => now(),
        ]);
        $employee->assignRole('ADMINISTRATOR','ACCOUNT');

        $employee2 = User::create([
            'name' => 'Dipak',
            'email' => 'dipak.acharya162@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$8Yjtc8Fqaws4UHDO71lOwesJ9HpvLDgUr3UJb.M4KZAillWJFtFKW', //123
            'remember_token' => now(),
        ]);
        $employee2->assignRole('ADMINISTRATOR','ACCOUNT');
    }
}

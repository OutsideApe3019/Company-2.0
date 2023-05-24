<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use User, Role, Permission, Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'user',
            'prefix' => 'User',
            'color' => '#aaaaaa',
        ]);

        $role['admin'] = Role::create([
            'name' => 'admin',
            'prefix' => 'Admin',
            'color' => '#ff5555',
        ]);

        Permission::create(['name' => '*']);

        Permission::create(['name' => 'panel.see']);

        Permission::create(['name' => 'panel.user.edit']);

        Permission::create(['name' => 'panel.role.create']);
        Permission::create(['name' => 'panel.role.edit']);
        Permission::create(['name' => 'panel.role.delete']);

        Permission::create(['name' => 'panel.perm.create']);
        Permission::create(['name' => 'panel.perm.delete']);

        Permission::create(['name' => 'panel.new.create']);
        Permission::create(['name' => 'panel.new.delete']);

        $role['admin']->givePermissionTo('*');

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@company.com',
            'password' => Hash::make('admin'),
        ]);

        $user->assignRole('admin');
    }
}

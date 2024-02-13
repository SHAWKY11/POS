<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'create',
        'read',
        'update',
        'delete',
        'create_category',
        'read_category',
        'update_category',
        'delete_category',
        'create_product',
        'read_product',
        'update_product',
        'delete_product',
        'create_client',
        'read_client',
        'update_client',
        'delete_client',
        'create_order',
        'read_order',
        'update_order',
        'delete_order',
        
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'first_name' => 'super',
            'last_name'  => 'admin',
            'email' => 'superadmin@app.com',
            'password' => Hash::make('123456'),
            // 'roles_name' => "owner",
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
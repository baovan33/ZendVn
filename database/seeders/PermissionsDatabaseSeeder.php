<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'create-user', 'guard_name' => 'web', 'group' => 'User'],
            ['name' => 'update-user', 'guard_name' => 'web', 'group' => 'User'],
            ['name' => 'show-user', 'guard_name' => 'web', 'group' => 'User'],
            ['name' => 'delete-user', 'guard_name' => 'web', 'group' => 'User'],

            ['name' => 'create-category', 'guard_name' => 'web', 'group' => 'category'],
            ['name' => 'update-category', 'guard_name' => 'web', 'group' => 'category'],
            ['name' => 'show-category', 'guard_name' => 'web', 'group' => 'category'],
            ['name' => 'delete-category', 'guard_name' => 'web', 'group' => 'category'],

            ['name' => 'create-role', 'guard_name' => 'web', 'group' => 'role'],
            ['name' => 'update-role', 'guard_name' => 'web', 'group' => 'role'],
            ['name' => 'show-role', 'guard_name' => 'web', 'group' => 'role'],
            ['name' => 'delete-role', 'guard_name' => 'web', 'group' => 'role'],

            ['name' => 'create-post', 'guard_name' => 'web', 'group' => 'post'],
            ['name' => 'update-post', 'guard_name' => 'web', 'group' => 'post'],
            ['name' => 'show-post', 'guard_name' => 'web', 'group' => 'post'],
            ['name' => 'delete-post', 'guard_name' => 'web', 'group' => 'post'],

        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate($permission);
        }
    }
}

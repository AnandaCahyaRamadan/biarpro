<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat role untuk user
        $superadmin = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $contributor = Role::create([
            'name' => 'contributor',
            'guard_name' => 'web',
        ]);

        $contributorPro = Role::create([
            'name' => 'contributor-pro',
            'guard_name' => 'web',
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'Superadmin@gmail.com',
            'no_personal' => '081128832184',
            'no_bisnis' => '082298317832',
            'alamat' => 'Banyuwangi',
            'kategori_bisnis_id' => 1,
            'password' => bcrypt('Sadmin2023'),
            'email_verified_at' => '2023-07-12 15:18:26',
        ]);
        $superadmin->assignRole('super-admin');

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => ' ',
            'email' => 'admin@gmail.com',
            'no_personal' => '081128832184',
            'no_bisnis' => '082298317832',
            'alamat' => 'Banyuwangi',
            'kategori_bisnis_id' => 1,
            'password' => bcrypt('Admin2023'),
            'email_verified_at' => '2023-07-12 15:18:26',
        ]);
        $admin->assignRole('admin');

        $contibutor = User::create([
            'first_name' => 'Contributor',
            'last_name' => ' ',
            'email' => 'contributor@gmail.com',
            'no_personal' => '081128832184',
            'no_bisnis' => '082298317832',
            'alamat' => 'Banyuwangi',
            'kategori_bisnis_id' => 1,
            'password' => bcrypt('Contri2023'),
            'email_verified_at' => '2023-07-12 15:18:26',
        ]);
        $contibutor->assignRole('contributor');

        $contibutorPro = User::create([
            'first_name' => 'ContributorPro',
            'last_name' => ' ',
            'email' => 'contributorpro@gmail.com',
            'no_personal' => '081128832184',
            'no_bisnis' => '082298317832',
            'alamat' => 'Banyuwangi',
            'kategori_bisnis_id' => 1,
            'password' => bcrypt('Contripro2023'),
            'email_verified_at' => '2023-07-12 15:18:26',
        ]);
        $contibutorPro->assignRole('contributor-pro');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Role
        $adminRole = Role::create(['name' => 'administrator']);
        $kasirRole = Role::create(['name' => 'kasir']);
        $customerRole = Role::create(['name' => 'customer']);

        // 2. Buat User Contoh untuk Admin (Guru)
        $admin = User::create([
            'name' => 'Pak Guru Admin',
            'email' => 'admin@smkn10.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole($adminRole);

        // 3. Buat User Contoh untuk Kasir (Siswa Penjaga)
        $kasir = User::create([
            'name' => 'Siswa Kasir',
            'email' => 'kasir@smkn10.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $kasir->assignRole($kasirRole);

        // 4. Buat User Contoh untuk Customer (Siswa Pembeli)
        $customer = User::create([
            'name' => 'Almer Siswa',
            'email' => 'almer@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $customer->assignRole($customerRole);
    }
}

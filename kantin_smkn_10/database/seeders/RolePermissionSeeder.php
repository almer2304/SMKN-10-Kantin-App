<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Product permissions
            'view products',
            'create products',
            'edit products',
            'delete products',
            
            // Category permissions
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            
            // Order permissions
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',
            
            // Transaction permissions
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            
            // Cart permissions
            'view cart',
            'manage cart',
            
            // Dashboard permissions
            'view dashboard',
            
            // Report permissions
            'view reports',
            'generate reports',
            
            // User management
            'view users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $customerRole = Role::create(['name' => 'customer']);
        $customerRole->givePermissionTo([
            'view products',
            'view cart',
            'manage cart',
        ]);

        $cashierRole = Role::create(['name' => 'cashier']);
        $cashierRole->givePermissionTo([
            'view products',
            'view categories',
            'view orders',
            'create orders',
            'edit orders',
            'view transactions',
            'create transactions',
            'edit transactions',
            'view dashboard',
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@kantin.com',
            'password' => bcrypt('password123'),
            'nis' => 'ADM001',
            'class' => 'Guru',
            'phone' => '081234567890',
            'address' => 'Sekolah',
            'wallet_balance' => 0,
        ]);
        $admin->assignRole('admin');

        // Create cashier user
        $cashier = User::create([
            'name' => 'Kasir Sekolah',
            'email' => 'kasir@kantin.com',
            'password' => bcrypt('password123'),
            'nis' => 'KSR001',
            'class' => 'XII IPA',
            'phone' => '081234567891',
            'address' => 'Sekolah',
            'wallet_balance' => 0,
        ]);
        $cashier->assignRole('cashier');

        // Create customer user
        $customer = User::create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@kantin.com',
            'password' => bcrypt('password123'),
            'nis' => 'SIS001',
            'class' => 'X IPA 1',
            'phone' => '081234567892',
            'address' => 'Jl. Sekolah No. 1',
            'wallet_balance' => 100000,
        ]);
        $customer->assignRole('customer');
    }
}
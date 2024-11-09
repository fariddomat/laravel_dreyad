<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // إنشاء الصلاحيات
            Permission::create(['name' => 'manage patients']);
            Permission::create(['name' => 'manage appointments']);
            Permission::create(['name' => 'view reports']);
            // إضافة المزيد من الصلاحيات حسب الحاجة...

            // إنشاء الأدوار وتخصيص الصلاحيات
            $admin = Role::create(['name' => 'admin']);
            $admin->givePermissionTo(['manage patients', 'manage appointments', 'view reports']);

            $doctor = Role::create(['name' => 'doctor']);
            $doctor->givePermissionTo(['manage patients', 'view reports']); // صلاحيات الطبيب

            $receptionist = Role::create(['name' => 'receptionist']);
            $receptionist->givePermissionTo(['manage appointments']);

            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@project.com',
                'password' => bcrypt('password'), // Replace with a secure password
                // ... other user attributes ...
            ]);
            $user->assignRole('admin');
        }
    }
}

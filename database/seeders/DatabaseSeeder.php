<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Enums\UserRole;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users for each role
        User::factory()->create([
            'name' => 'Chủ Trại Nuôi',
            'email' => 'owner@example.com',
            'role' => UserRole::OWNER,
        ]);

        User::factory()->create([
            'name' => 'Kỹ Thuật Viên',
            'email' => 'technician@example.com',
            'role' => UserRole::TECHNICIAN,
        ]);

        User::factory()->create([
            'name' => 'Nhân Viên Kho',
            'email' => 'warehouse@example.com',
            'role' => UserRole::WAREHOUSE_STAFF,
        ]);

        User::factory()->create([
            'name' => 'Kế Toán',
            'email' => 'accountant@example.com',
            'role' => UserRole::ACCOUNTANT,
        ]);

        User::factory()->create([
            'name' => 'Người Thu Hoạch',
            'email' => 'harvester@example.com',
            'role' => UserRole::HARVESTER,
        ]);

        User::factory()->create([
            'name' => 'Admin Hệ Thống',
            'email' => 'admin@example.com',
            'role' => UserRole::SYSTEM_ADMIN,
        ]);
    }
}

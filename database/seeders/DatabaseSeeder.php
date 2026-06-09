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
            'username' => 'owner',
            'role' => UserRole::OWNER,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Kỹ Thuật Viên',
            'email' => 'technician@example.com',
            'username' => 'technician',
            'role' => UserRole::TECHNICIAN,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Nhân Viên Kho',
            'email' => 'warehouse@example.com',
            'username' => 'warehouse',
            'role' => UserRole::WAREHOUSE_STAFF,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Kế Toán',
            'email' => 'accountant@example.com',
            'username' => 'accountant',
            'role' => UserRole::ACCOUNTANT,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Người Thu Hoạch',
            'email' => 'harvester@example.com',
            'username' => 'harvester',
            'role' => UserRole::HARVESTER,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Admin Hệ Thống',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'role' => UserRole::SYSTEM_ADMIN,
            'status' => 'active',
        ]);

        // Seed default Farming Zone
        $zoneA = \App\Models\FarmingZone::create([
            'code' => 'ZONE-A',
            'name' => 'Khu Nuôi Cánh Tây',
            'total_area' => 50000.00,
            'location' => 'Phía Tây đê bao sông Hậu',
            'status' => 'active'
        ]);

        // Seed Ponds nested under Zone A
        $zoneA->ponds()->createMany([
            [
                'code' => 'A-01',
                'name' => 'Ao Rearing 01',
                'mouth_diameter' => 30.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 26.0,
                'area' => 530.93,
                'pond_type' => 'rearing',
                'status' => 'rearing'
            ],
            [
                'code' => 'A-02',
                'name' => 'Ao Rearing 02',
                'mouth_diameter' => 30.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 26.0,
                'area' => 530.93,
                'pond_type' => 'rearing',
                'status' => 'rearing'
            ],
            [
                'code' => 'A-03',
                'name' => 'Ao Rearing 03',
                'mouth_diameter' => 32.0,
                'border_exclusion' => 2.5,
                'bottom_diameter' => 27.0,
                'area' => 572.56,
                'pond_type' => 'rearing',
                'status' => 'rearing'
            ],
            [
                'code' => 'A-04',
                'name' => 'Ao Gièo Ươm A',
                'mouth_diameter' => 15.0,
                'border_exclusion' => 1.5,
                'bottom_diameter' => 12.0,
                'area' => 113.10,
                'pond_type' => 'nursery',
                'status' => 'rehabilitating'
            ],
            [
                'code' => 'A-05',
                'name' => 'Ao Rearing 05',
                'mouth_diameter' => 30.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 26.0,
                'area' => 530.93,
                'pond_type' => 'rearing',
                'status' => 'empty'
            ]
        ]);
    }
}

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
        $ponds = $zoneA->ponds()->createMany([
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

        // Seed Suppliers
        $sup1 = \App\Models\Supplier::create([
            'name' => 'Công ty TNHH C.P. Việt Nam',
            'address' => 'KCN Trà Nóc, Cần Thơ',
            'phone' => '0291-3829-xxx',
            'email' => 'contact@cp.com.vn',
            'supply_type' => 'seeds, feed',
            'debt' => 45000000.00
        ]);

        $sup2 = \App\Models\Supplier::create([
            'name' => 'Tập đoàn Thủy sản Việt Úc',
            'address' => 'Phan Thiết, Bình Thuận',
            'phone' => '1900 7878',
            'email' => 'info@vietuc.com',
            'supply_type' => 'seeds',
            'debt' => 0.00
        ]);

        $sup3 = \App\Models\Supplier::create([
            'name' => 'Đại lý Vật tư Thủy sản Aqua Bạc Liêu',
            'address' => 'TP. Bạc Liêu, Bạc Liêu',
            'phone' => '0918-234-xxx',
            'email' => 'baclieuaqua@gmail.com',
            'supply_type' => 'materials, chemicals',
            'debt' => 47400000.00
        ]);

        // Seed Customers
        $cust1 = \App\Models\Customer::create([
            'name' => 'Thương lái Trần Văn Thành',
            'address' => 'Bạc Liêu, Sóc Trăng',
            'phone' => '0909-382-xxx',
            'email' => 'thanhtran@gmail.com',
            'debt' => 0.00
        ]);

        $cust2 = \App\Models\Customer::create([
            'name' => 'Công ty XNK Thủy sản Minh Phú',
            'address' => 'Cà Mau, Hậu Giang',
            'phone' => '0291-3822xxx',
            'email' => 'contact@minhphu.com',
            'debt' => 0.00
        ]);

        $cust3 = \App\Models\Customer::create([
            'name' => 'Thương lái Nguyễn Thị Lan',
            'address' => 'Bến Tre, Trà Vinh',
            'phone' => '0913-928-xxx',
            'email' => 'lannguyen@gmail.com',
            'debt' => 190000000.00
        ]);

        // Seed Materials
        \App\Models\Material::create([
            'supplier_id' => $sup1->id,
            'name' => 'Thức ăn GrowMax 02',
            'type' => 'feed',
            'brand' => 'GrowMax',
            'unit' => 'Bao (25kg)',
            'stock_quantity' => 1200.00,
            'unit_price' => 380000.00
        ]);

        \App\Models\Material::create([
            'supplier_id' => $sup3->id,
            'name' => 'Khoáng bột AquaMineral',
            'type' => 'mineral',
            'brand' => 'AquaMineral',
            'unit' => 'Bao (10kg)',
            'stock_quantity' => 12.00,
            'unit_price' => 250000.00
        ]);

        // Seed Cultivation Cycles
        $cycleA = \App\Models\CultivationCycle::create([
            'code' => 'VU-2026-A',
            'name' => 'Vụ Nuôi Hè Thu 2026',
            'start_date' => '2026-05-15',
            'expected_end_date' => '2026-08-15',
            'status' => 'active'
        ]);

        $cycleB = \App\Models\CultivationCycle::create([
            'code' => 'VU-2026-B',
            'name' => 'Vụ Thả Thử Nghiệm CNC',
            'start_date' => '2026-06-01',
            'expected_end_date' => '2026-09-01',
            'status' => 'active'
        ]);

        // Seed Seed Batches
        \App\Models\SeedBatch::create([
            'cultivation_cycle_id' => $cycleA->id,
            'pond_id' => $ponds[0]->id,
            'supplier_id' => $sup1->id,
            'lot_number' => 'LG-CP-009',
            'quantity' => 300000,
            'stocking_date' => '2026-05-20',
            'stocking_density' => 150.00,
            'seed_type' => 'Tôm thẻ chân trắng'
        ]);

        \App\Models\SeedBatch::create([
            'cultivation_cycle_id' => $cycleB->id,
            'pond_id' => $ponds[2]->id,
            'supplier_id' => $sup2->id,
            'lot_number' => 'LG-VU-012',
            'quantity' => 400000,
            'stocking_date' => '2026-06-02',
            'stocking_density' => 120.00,
            'seed_type' => 'Tôm thẻ chân trắng'
        ]);

        // Seed Water Quality Logs (Ao Nuoi, Ao Lang, Cau Cap)
        \App\Models\WaterQualityLog::create([
            'date' => '2026-06-10',
            'time' => '09:00:00',
            'sampling_location' => 'Ao Rearing 01',
            'salinity' => 15.00,
            'ph' => 7.80,
            'transparency' => 35.00,
            'tidal_peak' => 1.80,
            'water_level' => 1.20
        ]);

        \App\Models\WaterQualityLog::create([
            'date' => '2026-06-10',
            'time' => '08:45:00',
            'sampling_location' => 'Ao Rearing 02',
            'salinity' => 14.00,
            'ph' => 8.20,
            'transparency' => 30.00,
            'tidal_peak' => 1.70,
            'water_level' => 1.10
        ]);

        \App\Models\WaterQualityLog::create([
            'date' => '2026-06-10',
            'time' => '07:30:00',
            'sampling_location' => 'Ao Lắng A',
            'salinity' => 16.50,
            'ph' => 7.90,
            'transparency' => 45.00,
            'tidal_peak' => null,
            'water_level' => null
        ]);

        \App\Models\WaterQualityLog::create([
            'date' => '2026-06-09',
            'time' => '15:20:00',
            'sampling_location' => 'Ao Lắng B',
            'salinity' => 15.80,
            'ph' => 8.10,
            'transparency' => 42.00,
            'tidal_peak' => null,
            'water_level' => null
        ]);

        \App\Models\WaterQualityLog::create([
            'date' => '2026-06-10',
            'time' => '06:15:00',
            'sampling_location' => 'Cầu Cấp A',
            'salinity' => 14.50,
            'ph' => null,
            'transparency' => null,
            'tidal_peak' => 2.10,
            'water_level' => 1.85
        ]);

        \App\Models\WaterQualityLog::create([
            'date' => '2026-06-10',
            'time' => '18:30:00',
            'sampling_location' => 'Cầu Cấp B',
            'salinity' => 15.20,
            'ph' => null,
            'transparency' => null,
            'tidal_peak' => 1.95,
            'water_level' => 1.60
        ]);

        // Seed Technical Logs
        \App\Models\TechnicalLog::create([
            'cultivation_cycle_id' => $cycleA->id,
            'pond_id' => $ponds[0]->id,
            'date' => '2026-06-10',
            'doc' => 26,
            'water_level' => 1.20,
            'ph' => 7.80,
            'feed_amount' => 45.00,
            'siphon_amount' => 1.50,
            'shrimp_size' => 14.20,
            'adg' => 0.25,
            'fcr' => 1.20,
            'notes' => 'Tôm khỏe mạnh, ăn mạnh.'
        ]);

        // Seed Harvests
        $harv1 = \App\Models\Harvest::create([
            'cultivation_cycle_id' => $cycleA->id,
            'pond_id' => $ponds[4]->id,
            'harvest_date' => '2026-05-10',
            'doc' => 90,
            'harvest_type' => 'total',
            'shrimp_condition' => 'alive',
            'weight' => 4200.00,
            'quantity' => 160000,
            'size_range' => '35-40 con/kg',
            'unit_price' => 160000.00,
            'total_amount' => 672000000.00,
            'net_rental_fee' => 0,
            'net_amount' => 672000000.00
        ]);

        // Seed Sales Invoices
        \App\Models\SalesInvoice::create([
            'customer_id' => $cust1->id,
            'harvest_id' => $harv1->id,
            'invoice_number' => 'HD-2026-041',
            'invoice_date' => '2026-05-10',
            'total_amount' => 672000000.00,
            'paid_amount' => 672000000.00,
            'status' => 'paid'
        ]);

        // Seed Operating Expenses
        \App\Models\OperatingExpense::create([
            'date' => '2026-06-05',
            'expense_type' => 'electricity',
            'description' => 'Thanh toán tiền điện trạm hạ thế tháng 05',
            'amount' => 54200000.00,
            'cost_center_type' => 'farming_zone',
            'cost_center_id' => $zoneA->id,
            'allocation_method' => 'direct'
        ]);
    }
}

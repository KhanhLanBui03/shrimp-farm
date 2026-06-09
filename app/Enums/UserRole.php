<?php

namespace App\Enums;

enum UserRole: string
{
    case OWNER = 'owner';
    case TECHNICIAN = 'technician';
    case WAREHOUSE_STAFF = 'warehouse_staff';
    case ACCOUNTANT = 'accountant';
    case HARVESTER = 'harvester';
    case SYSTEM_ADMIN = 'system_admin';

    /**
     * Get the display label for the role in Vietnamese.
     */
    public function label(): string
    {
        return match($this) {
            self::OWNER => 'Chủ trại nuôi',
            self::TECHNICIAN => 'Kỹ thuật viên',
            self::WAREHOUSE_STAFF => 'Nhân viên kho',
            self::ACCOUNTANT => 'Kế toán',
            self::HARVESTER => 'Người thu hoạch',
            self::SYSTEM_ADMIN => 'Admin hệ thống',
        };
    }
}

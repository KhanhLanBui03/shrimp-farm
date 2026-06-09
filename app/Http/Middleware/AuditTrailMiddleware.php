<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditTrailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Chỉ log khi đã đăng nhập và là các request thay đổi dữ liệu (POST, PUT, PATCH, DELETE)
        if (Auth::check() && in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $action = $this->getActionName($request);
            $description = $this->getDescription($request);

            // Kiểm tra xem đã có log trùng trong request này chưa (tránh trùng lặp với log thủ công)
            $exists = AuditLog::where('user_id', Auth::id())
                ->where('action', $action)
                ->where('created_at', '>=', now()->subSeconds(2))
                ->exists();

            if (!$exists) {
                AuditLog::create([
                    'user_id' => Auth::id(),
                    'action' => $action,
                    'description' => $description,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }
        }

        return $response;
    }

    private function getActionName(Request $request)
    {
        $method = $request->method();
        $path = $request->path();

        if (str_contains($path, 'login')) {
            return 'Đăng nhập';
        }
        if (str_contains($path, 'logout')) {
            return 'Đăng xuất';
        }
        if (str_contains($path, 'toggle-status')) {
            return 'Khóa/Mở tài khoản';
        }
        if (str_contains($path, 'reset-password')) {
            return 'Đặt lại mật khẩu';
        }

        if ($method === 'POST') {
            return 'Thêm mới';
        } elseif (in_array($method, ['PUT', 'PATCH'])) {
            return 'Cập nhật';
        } elseif ($method === 'DELETE') {
            return 'Xóa dữ liệu';
        }

        return $method;
    }

    private function getDescription(Request $request)
    {
        $path = $request->path();
        $method = $request->method();

        if (str_contains($path, 'login')) {
            return "Đã đăng nhập vào hệ thống.";
        }
        if (str_contains($path, 'logout')) {
            return "Đã đăng xuất khỏi hệ thống.";
        }

        // Tạo mô tả thân thiện dựa vào URL path
        $module = 'Hệ thống';
        if (str_contains($path, 'farming-zones')) {
            $module = 'Khu nuôi';
        } elseif (str_contains($path, 'ponds')) {
            $module = 'Ao nuôi';
        } elseif (str_contains($path, 'users')) {
            $module = 'Tài khoản';
        } elseif (str_contains($path, 'cultivation-cycles')) {
            $module = 'Vụ nuôi';
        } elseif (str_contains($path, 'seed-batches')) {
            $module = 'Thả giống';
        } elseif (str_contains($path, 'suppliers')) {
            $module = 'Nhà cung cấp';
        } elseif (str_contains($path, 'technical-logs')) {
            $module = 'Nhật ký kỹ thuật';
        } elseif (str_contains($path, 'water-quality-logs')) {
            $module = 'Chỉ số nước';
        } elseif (str_contains($path, 'materials')) {
            $module = 'Vật tư';
        } elseif (str_contains($path, 'sales-invoices')) {
            $module = 'Hóa đơn bán hàng';
        } elseif (str_contains($path, 'operating-expenses')) {
            $module = 'Chi phí vận hành';
        } elseif (str_contains($path, 'harvests')) {
            $module = 'Thu hoạch';
        } elseif (str_contains($path, 'customers')) {
            $module = 'Khách hàng';
        } elseif (str_contains($path, 'profile')) {
            $module = 'Hồ sơ cá nhân';
        }

        $code = $request->input('code') ?: $request->input('name') ?: '';
        $detail = $code ? " ($code)" : "";

        if (str_contains($path, 'toggle-status')) {
            return "Đã thay đổi trạng thái hoạt động tài khoản.";
        }
        if (str_contains($path, 'reset-password')) {
            return "Đã đổi mật khẩu cho tài khoản.";
        }

        if ($method === 'POST') {
            return "Đã thêm mới dữ liệu trong module {$module}{$detail}.";
        } elseif (in_array($method, ['PUT', 'PATCH'])) {
            return "Đã cập nhật thông tin trong module {$module}{$detail}.";
        } elseif ($method === 'DELETE') {
            return "Đã xóa dữ liệu trong module {$module}.";
        }

        return "Thao tác trên đường dẫn /{$path}";
    }
}

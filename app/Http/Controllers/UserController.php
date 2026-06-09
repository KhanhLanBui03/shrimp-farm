<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        $totalUsers = $users->count();
        $activeUsers = $users->where('status', 'active')->count();
        $lockedUsers = $users->where('status', 'inactive')->count();
        
        $rolesCount = [
            'owner' => $users->where('role', UserRole::OWNER)->count(),
            'technician' => $users->where('role', UserRole::TECHNICIAN)->count(),
            'warehouse' => $users->where('role', UserRole::WAREHOUSE_STAFF)->count(),
            'accountant' => $users->where('role', UserRole::ACCOUNTANT)->count(),
            'harvester' => $users->where('role', UserRole::HARVESTER)->count(),
            'admin' => $users->where('role', UserRole::SYSTEM_ADMIN)->count(),
        ];

        return view('users.index', compact('users', 'totalUsers', 'activeUsers', 'lockedUsers', 'rolesCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(array_column(UserRole::cases(), 'value'))],
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'], // Băm tự động nhờ casts hashed trong Model
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        // Tạo log audit trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Tạo tài khoản',
            'description' => "Đã tạo tài khoản mới: {$user->name} (Username: {$user->username}, Vai trò: " . $user->role->label() . ")",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')->with('success', 'Tạo tài khoản mới thành công!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(array_column(UserRole::cases(), 'value'))],
            'status' => 'required|in:active,inactive',
        ]);

        // Tránh tự khóa tài khoản của chính mình
        if ($user->id === Auth::id() && $validated['status'] === 'inactive') {
            return redirect()->route('users.index')->with('error', 'Bạn không thể tự khóa tài khoản của chính mình!');
        }

        $user->update($validated);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Cập nhật tài khoản',
            'description' => "Đã cập nhật thông tin tài khoản: {$user->username} (Vai trò mới: " . $user->role->label() . ")",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')->with('success', 'Cập nhật thông tin tài khoản thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Tránh tự xóa tài khoản của chính mình
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Bạn không thể tự xóa tài khoản của chính mình!');
        }

        $username = $user->username;
        $user->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Xóa tài khoản',
            'description' => "Đã xóa tài khoản: {$username}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')->with('success', 'Xóa tài khoản thành công!');
    }

    /**
     * Toggle status (Lock / Unlock)
     */
    public function toggleStatus(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Bạn không thể tự khóa/mở tài khoản của chính mình!');
        }

        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $actionText = $newStatus === 'active' ? 'Mở khóa tài khoản' : 'Khóa tài khoản';

        $user->update(['status' => $newStatus]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $actionText,
            'description' => "Đã thực hiện {$actionText} đối với: {$user->username}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')->with('success', "{$actionText} thành công!");
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $user->update([
            'password' => $validated['password'], // Băm tự động nhờ casts
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Đặt lại mật khẩu',
            'description' => "Đã đặt lại mật khẩu cho tài khoản: {$user->username}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('users.index')->with('success', 'Đặt lại mật khẩu thành công!');
    }
}

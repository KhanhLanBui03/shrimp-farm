<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request (OTP generation).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Kiểm tra trạng thái hoạt động của tài khoản
        if ($user->status === 'inactive') {
            throw ValidationException::withMessages([
                'email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.',
            ]);
        }

        // Tạo mã OTP ngẫu nhiên gồm 6 chữ số
        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        // Lưu thông tin đăng nhập tạm thời vào session
        session([
            'login_otp' => [
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => $expiresAt->toIso8601String(),
                'remember' => $request->boolean('remember'),
            ]
        ]);

        // Gửi OTP qua email (log hoặc mail thực tế tùy cấu hình)
        try {
            Mail::raw("Mã xác thực OTP đăng nhập hệ thống AquaControl của bạn là: {$otp}. Mã này có hiệu lực trong 10 phút. Nếu bạn không yêu cầu đăng nhập, hãy bỏ qua email này.", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('[AquaControl] Mã OTP xác thực đăng nhập');
            });
        } catch (\Exception $e) {
            logger()->error('Không gửi được email OTP: ' . $e->getMessage());
        }

        return redirect()->route('login.otp');
    }

    /**
     * Show the OTP verification form.
     */
    public function otpCreate(): View|RedirectResponse
    {
        if (! session()->has('login_otp')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước.');
        }

        return view('auth.otp-verify');
    }

    /**
     * Handle the OTP verification request.
     */
    public function otpStore(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if (! session()->has('login_otp')) {
            return redirect()->route('login')->with('error', 'Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại.');
        }

        $otpData = session('login_otp');

        // Kiểm tra mã OTP hết hạn
        if (now()->isAfter(now()->parse($otpData['expires_at']))) {
            session()->forget('login_otp');
            return redirect()->route('login')->with('error', 'Mã OTP đã hết hạn. Vui lòng đăng nhập lại.');
        }

        // Kiểm tra mã OTP trùng khớp
        if ($request->otp != $otpData['otp']) {
            throw ValidationException::withMessages([
                'otp' => 'Mã xác thực OTP không chính xác.',
            ]);
        }

        // Đăng nhập người dùng
        Auth::loginUsingId($otpData['user_id'], $otpData['remember']);

        // Xóa thông tin OTP tạm thời
        session()->forget('login_otp');
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Resend the OTP code.
     */
    public function otpResend(Request $request): RedirectResponse
    {
        if (! session()->has('login_otp')) {
            return redirect()->route('login')->with('error', 'Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại.');
        }

        $otpData = session('login_otp');
        $user = User::find($otpData['user_id']);

        if (! $user) {
            return redirect()->route('login')->with('error', 'Người dùng không tồn tại.');
        }

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        // Cập nhật session OTP mới
        $otpData['otp'] = $otp;
        $otpData['expires_at'] = $expiresAt->toIso8601String();
        session(['login_otp' => $otpData]);

        // Gửi lại email
        try {
            Mail::raw("Mã xác thực OTP đăng nhập hệ thống AquaControl mới của bạn là: {$otp}. Mã này có hiệu lực trong 10 phút.", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('[AquaControl] Gửi lại mã OTP xác thực đăng nhập');
            });
        } catch (\Exception $e) {
            logger()->error('Không gửi lại được email OTP: ' . $e->getMessage());
        }

        return redirect()->route('login.otp')->with('status', 'Mã OTP mới đã được gửi vào email của bạn.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class OtpPasswordResetController extends Controller
{
    /**
     * Send OTP to the given email
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Không tìm thấy tài khoản nào với địa chỉ email này.',
        ]);

        $email = $request->email;
        $otp = (string) rand(100000, 999999);

        // Store OTP in cache for 5 minutes
        Cache::put('password_reset_otp_' . $email, $otp, now()->addMinutes(5));

        // Send Email
        Mail::to($email)->send(new SendOtpMail($otp, $email));

        // Redirect to verify page
        return redirect()->route('password.verify_otp')->with('email_for_otp', $email);
    }

    /**
     * Show OTP Verify Form
     */
    public function showVerifyForm(Request $request)
    {
        // If email is in session, pre-fill it.
        $email = session('email_for_otp');
        if (!$email) {
            return redirect()->route('password.request');
        }

        // We re-flash the session variable so it's not lost on validation error reload
        session()->keep(['email_for_otp']);

        return view('auth.verify-otp', ['email' => $email]);
    }

    /**
     * Verify the OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $email = $request->email;
        $otp = $request->otp;

        $cachedOtp = Cache::get('password_reset_otp_' . $email);

        if (!$cachedOtp || (string) $cachedOtp !== (string) $otp) {
            // Re-flash email_for_otp so it stays in the view
            session()->flash('email_for_otp', $email);
            return back()->withInput($request->only('email', 'otp'))->withErrors(['otp' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn.']);
        }

        // OTP is correct
        Cache::forget('password_reset_otp_' . $email);

        // Set session to allow reset password
        session(['otp_verified_email' => $email]);

        return redirect()->route('password.reset');
    }

    /**
     * Show Reset Password Form
     */
    public function showResetForm()
    {
        $email = session('otp_verified_email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Bạn cần xác thực OTP trước khi đổi mật khẩu.']);
        }

        return view('auth.reset-password', ['email' => $email]);
    }

    /**
     * Reset Password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check if the session is still valid for this email
        $verifiedEmail = session('otp_verified_email');
        if (!$verifiedEmail || $verifiedEmail !== $request->email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Phiên làm việc không hợp lệ hoặc đã hết hạn. Vui lòng thử lại.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear session
        session()->forget('otp_verified_email');

        return redirect()->route('login')->with('status', 'Mật khẩu đã được thiết lập lại thành công. Bạn có thể đăng nhập bằng mật khẩu mới.');
    }
}

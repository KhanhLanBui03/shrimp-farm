<x-guest-layout>
    <!-- Header title -->
    <div class="mb-6">
        <h2 class="text-lg font-black text-slate-900 uppercase">Xác thực mã OTP</h2>
        <p class="text-[11px] text-slate-400 uppercase tracking-wider mt-1 font-semibold">Nhập mã OTP được gửi tới email của bạn</p>
    </div>

    <!-- Session Status / Errors -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('error'))
        <div class="mb-4 text-sm font-semibold text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.otp') }}" class="space-y-5">
        @csrf

        <!-- OTP Code -->
        <div>
            <label for="otp" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Mã xác thực OTP (6 chữ số)</label>
            <input id="otp" type="text" name="otp" required autofocus placeholder="******" maxlength="6"
                   class="w-full text-center tracking-[0.5em] text-lg font-extrabold bg-slate-50/50 border border-slate-200 p-3 focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('otp')" class="mt-1" />
        </div>

        <!-- Action Button -->
        <div>
            <button type="submit" class="w-full text-center text-xs font-bold uppercase tracking-wider text-white bg-slate-900 hover:bg-slate-800 py-3.5 rounded-lg hover:shadow-lg hover:shadow-slate-900/10 transition-all">
                Xác thực & Đăng nhập
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('login.otp.resend') }}" class="mt-4 text-center">
        @csrf
        <button type="submit" class="text-xs font-bold text-[#16a34a] hover:text-[#15803d] transition-colors uppercase tracking-wider">
            Gửi lại mã OTP
        </button>
    </form>
</x-guest-layout>

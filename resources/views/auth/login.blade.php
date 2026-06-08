<x-guest-layout>
    <!-- Header title -->
    <div class="mb-6">
        <h2 class="text-lg font-black text-slate-900 uppercase">Đăng nhập hệ thống</h2>
        <p class="text-[11px] text-slate-400 uppercase tracking-wider mt-1 font-semibold">AquaControl console credentials</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Địa chỉ Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-[11px] font-semibold text-slate-600 uppercase tracking-wider">Mật khẩu</label>
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-semibold text-slate-400 hover:text-slate-900 transition-colors" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                   class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="border border-slate-200 text-[#16a34a] focus:ring-emerald-500/20 rounded bg-slate-50">
                <span class="ms-2 text-xs font-medium text-slate-500">Ghi nhớ đăng nhập</span>
            </label>
        </div>

        <!-- Action Button -->
        <div>
            <button type="submit" class="w-full text-center text-xs font-bold uppercase tracking-wider text-white bg-slate-900 hover:bg-slate-800 py-3.5 rounded-lg hover:shadow-lg hover:shadow-slate-900/10 transition-all">
                Đăng nhập hệ thống
            </button>
        </div>

        <!-- Create Account link -->
        <div class="pt-2 text-center border-t border-slate-100">
            <span class="text-xs text-slate-400">Chưa có tài khoản trang trại?</span>
            <a href="{{ route('register') }}" class="text-xs font-bold text-[#16a34a] hover:text-[#15803d] transition-colors ml-1 uppercase tracking-wider">
                Đăng ký ngay
            </a>
        </div>
    </form>
</x-guest-layout>

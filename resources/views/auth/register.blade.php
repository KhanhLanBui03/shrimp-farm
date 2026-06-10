<x-guest-layout>
    <!-- Header title -->
    <div class="mb-6">
        <h2 class="text-lg font-black text-slate-900 uppercase">Đăng ký tài khoản</h2>
        <p class="text-[11px] text-slate-400 uppercase tracking-wider mt-1 font-semibold">AquaControl console registration</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Họ và tên</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                   class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Địa chỉ Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                   class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Vai trò trong trang trại</label>
            <select id="role" name="role" required 
                    class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                @foreach(App\Enums\UserRole::cases() as $role)
                    <option value="{{ $role->value }}" {{ old('role') === $role->value ? 'selected' : '' }}>
                        {{ $role->label() }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Mật khẩu</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                   class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-[11px] font-semibold text-slate-600 mb-2 uppercase tracking-wider">Xác nhận mật khẩu</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                   class="w-full bg-slate-50/50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Terms & Conditions -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox" required class="border border-slate-200 text-[#16a34a] focus:ring-emerald-500/20 rounded bg-slate-50">
            </div>
            <div class="ms-3 text-xs">
                <label for="terms" class="font-medium text-slate-500">Tôi đồng ý với <a href="#" class="text-[#16a34a] hover:underline font-semibold">Điều khoản sử dụng</a> và <a href="#" class="text-[#16a34a] hover:underline font-semibold">Chính sách bảo mật</a></label>
                <x-input-error :messages="$errors->get('terms')" class="mt-1" />
            </div>
        </div>

        <!-- Action Button -->
        <div>
            <button type="submit" class="w-full text-center text-xs font-bold uppercase tracking-wider text-white bg-[#16a34a] hover:bg-[#15803d] py-3.5 rounded-lg hover:shadow-lg hover:shadow-emerald-500/10 transition-all">
                Đăng ký tài khoản
            </button>
        </div>

        <!-- Already registered link -->
        <div class="pt-2 text-center border-t border-slate-100">
            <span class="text-xs text-slate-400">Đã có tài khoản trang trại?</span>
            <a href="{{ route('login') }}" class="text-xs font-bold text-slate-900 hover:text-slate-700 transition-colors ml-1 uppercase tracking-wider">
                Đăng nhập ngay
            </a>
        </div>
    </form>
</x-guest-layout>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Đổi mật khẩu tài khoản
        </h2>

        <p class="mt-1 text-sm text-gray-650">
            Đảm bảo tài khoản của bạn đang sử dụng mật khẩu mạnh để tăng tính bảo mật.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Mật khẩu hiện tại" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Mật khẩu mới" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Xác nhận mật khẩu mới" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all">Lưu mật khẩu mới</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-500 font-semibold"
                >Đã đổi mật khẩu thành công.</p>
            @endif
        </div>
    </form>
</section>

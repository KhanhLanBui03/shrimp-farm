<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        {{ __('Quên mật khẩu? Không sao cả. Chỉ cần cung cấp địa chỉ email của bạn, chúng tôi sẽ gửi liên kết đặt lại mật khẩu qua email để bạn có thể tạo mật khẩu mới.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Địa chỉ Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Gửi liên kết đặt lại mật khẩu') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

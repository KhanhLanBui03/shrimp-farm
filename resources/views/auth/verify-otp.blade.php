<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        {{ __('Mã xác nhận OTP đã được gửi đến địa chỉ email của bạn. Vui lòng nhập mã OTP để tiếp tục. Mã này có hiệu lực trong vòng 5 phút.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.verify_otp.store') }}">
        @csrf

        <!-- Email Address (Readonly) -->
        <div>
            <x-input-label for="email" :value="__('Địa chỉ Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100" type="email" name="email" :value="$email ?? old('email')" readonly required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- OTP Code -->
        <div class="mt-4">
            <x-input-label for="otp" :value="__('Mã OTP (6 chữ số)')" />
            <x-text-input id="otp" class="block mt-1 w-full tracking-widest text-center text-lg" type="text" name="otp" required autofocus maxlength="6" pattern="\d{6}" placeholder="------" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Gửi lại mã OTP') }}
            </a>

            <x-primary-button>
                {{ __('Xác nhận OTP') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

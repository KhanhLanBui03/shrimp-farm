<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        {{ __('Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, vui lòng xác nhận địa chỉ email của bạn bằng cách nhấp vào liên kết chúng tôi vừa gửi cho bạn qua email. Nếu bạn không nhận được email, chúng tôi rất sẵn lòng gửi lại email khác.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Một liên kết xác nhận mới đã được gửi đến địa chỉ email bạn đã cung cấp khi đăng ký.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Gửi lại email xác nhận') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 font-medium">
                {{ __('Đăng xuất') }}
            </button>
        </form>
    </div>
</x-guest-layout>

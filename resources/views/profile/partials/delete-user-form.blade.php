<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Xóa tài khoản vĩnh viễn
        </h2>

        <p class="mt-1 text-sm text-gray-655">
            Một khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu liên quan sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào bạn muốn giữ lại.
        </p>
    </header>

    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all"
    >
        Yêu cầu xóa tài khoản
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-slate-900">
                Bạn có chắc chắn muốn xóa tài khoản này không?
            </h2>

            <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                Tất cả dữ liệu của bạn sẽ bị xóa vĩnh viễn khỏi hệ thống. Vui lòng nhập mật khẩu xác thực tài khoản của bạn để tiếp tục.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Mật khẩu của bạn" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all"
                    placeholder="Mật khẩu xác minh"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end space-x-2.5">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold text-xs uppercase tracking-wider">
                    Hủy bỏ
                </button>

                <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-lg font-bold text-xs uppercase tracking-wider shadow-sm">
                    Xác nhận xóa
                </button>
            </div>
        </form>
    </x-modal>
</section>

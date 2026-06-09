<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quản lý tài khoản & phân quyền
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-8">
                    <!-- Header with Badge -->
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="px-2.5 py-0.5 text-xs font-semibold text-emerald-800 bg-emerald-100 rounded-full">Hệ thống</span>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">Quản lý tài khoản & phân quyền</h3>
                        </div>
                    </div>

                    <p class="text-slate-600 text-sm max-w-2xl leading-relaxed mb-8">
                        Quản lý danh sách thành viên trong trang trại, cấp quyền truy cập theo vai trò (Chủ trại, Kỹ thuật viên, Thủ kho, Kế toán, Admin hệ thống) và giám sát nhật ký hoạt động.
                    </p>

                    <!-- Features Checklist -->
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Các nghiệp vụ chính đang triển khai</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-slate-700">Tạo tài khoản người dùng (mã hóa mật khẩu bcrypt)</span>
                            </div>
                            <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-slate-700">Gán vai trò: Chủ trại / KTV / Nhân viên kho / Kế toán / Admin hệ thống</span>
                            </div>
                            <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-slate-700">Đặt lại mật khẩu, khóa/mở tài khoản</span>
                            </div>
                            <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-slate-700">Log hoạt động người dùng (Audit trail): ai làm gì, lúc nào, IP nào</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Quản lý thành viên & Phân quyền
        </h2>
    </x-slot>

    <!-- Main Outer Wrapper under Alpine.js -->
    <div x-data="{
        activeTab: 'users',
        showModal: false,
        isEdit: false,
        showResetPasswordModal: false,
        resetPasswordData: { id: '', name: '', password: '' },
        
        // Form Data
        modalData: {
            id: '',
            name: '',
            username: '',
            email: '',
            password: '',
            role: 'technician',
            status: 'active'
        },

        // Open Dialog Modal
        openCreateModal() {
            this.isEdit = false;
            this.modalData = {
                id: '',
                name: '',
                username: '',
                email: '',
                password: '',
                role: 'technician',
                status: 'active'
            };
            this.showModal = true;
        },
        openEditModal(user) {
            this.isEdit = true;
            this.modalData = { 
                id: user.id,
                name: user.name,
                username: user.username,
                email: user.email,
                role: user.role,
                status: user.status
            };
            this.showModal = true;
        },
        openResetPasswordModal(user) {
            this.resetPasswordData = {
                id: user.id,
                name: user.name,
                password: ''
            };
            this.showResetPasswordModal = true;
        }
    }" 
    class="space-y-6">

        <!-- Top Navigation & Actions Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-200/80 pb-5 gap-4">
            <!-- Segmented Control Tabs -->
            <div class="flex bg-slate-100 p-1 rounded-xl w-fit">
                <button @click="activeTab = 'users'" 
                        :class="activeTab === 'users' ? 'bg-white text-slate-800 shadow-sm border border-slate-200/40' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all flex items-center space-x-2">
                    <svg class="w-4 h-4 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0110.081 21c-2.331 0-4.512-.645-6.374-1.766M15 19.128v-.003c0-1.113-.288-2.16-.786-3.07M15 7.5a3 3 0 11-6 0 3 3 0 016 0zm6 2.25a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zM6.25 13a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"></path>
                    </svg>
                    <span>Danh sách tài khoản</span>
                    <span class="bg-slate-200/80 text-slate-600 px-2 py-0.5 rounded-md text-[10px] font-bold" :class="activeTab === 'users' ? 'bg-slate-200/60 text-slate-700' : ''">{{ $totalUsers }}</span>
                </button>
                <button @click="activeTab = 'matrix'" 
                        :class="activeTab === 'matrix' ? 'bg-white text-slate-800 shadow-sm border border-slate-200/40' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all flex items-center space-x-2">
                    <svg class="w-4 h-4 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.599-3.751A11.959 11.959 0 0112 2.714z"></path>
                    </svg>
                    <span>Phân quyền chức năng</span>
                </button>
            </div>

            <!-- Header Action Button -->
            <button x-show="activeTab === 'users'"
                    @click="openCreateModal()" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm hover:shadow-indigo-650/10 transition-all flex items-center space-x-1.5 self-end sm:self-auto">
                <svg class="w-4 h-4 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                <span>Tạo tài khoản mới</span>
            </button>
        </div>

        <!-- Tab 1: Users Table List (Modern SaaS Seat view) -->
        <div x-show="activeTab === 'users'" x-transition>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px] whitespace-nowrap">
                                <th class="py-4 px-6">Thành viên</th>
                                <th class="py-4 px-6">Tài khoản</th>
                                <th class="py-4 px-6">Vai trò</th>
                                <th class="py-4 px-6">Trạng thái</th>
                                <th class="py-4 px-6">Ngày tham gia</th>
                                <th class="py-4 px-6 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50/40 transition-colors whitespace-nowrap">
                                    <!-- User profile and avatar -->
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <div class="flex items-center space-x-3.5">
                                            @php
                                                $roleClasses = match($user->role->value) {
                                                    'owner' => 'bg-slate-100 text-slate-800 border-slate-200',
                                                    'system_admin' => 'bg-indigo-50 text-indigo-700 border-indigo-150',
                                                    'technician' => 'bg-cyan-50 text-cyan-700 border-cyan-150',
                                                    'warehouse_staff' => 'bg-amber-50 text-amber-700 border-amber-150',
                                                    'accountant' => 'bg-emerald-50 text-emerald-700 border-emerald-150',
                                                    'harvester' => 'bg-violet-50 text-violet-700 border-violet-150',
                                                    default => 'bg-slate-50 text-slate-600 border-slate-200'
                                                };

                                                $words = explode(' ', $user->name);
                                                $initials = mb_substr($words[0] ?? '', 0, 1);
                                                if (count($words) > 1) {
                                                    $initials .= mb_substr(end($words), 0, 1);
                                                }
                                                $initials = mb_strtoupper($initials);
                                            @endphp
                                            <!-- Solid, sophisticated avatar circle -->
                                            <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-xs border uppercase tracking-wider {{ $roleClasses }}">
                                                {{ $initials }}
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center space-x-1.5">
                                                    <span class="font-bold text-slate-900 text-sm">{{ $user->name }}</span>
                                                    @if($user->id === Auth::id())
                                                        <span class="text-[9px] font-bold uppercase bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded border border-slate-200">Bạn</span>
                                                    @endif
                                                </div>
                                                <span class="text-slate-400 text-xs mt-0.5 block font-normal">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Username -->
                                    <td class="py-4 px-6 font-mono text-slate-500 whitespace-nowrap">
                                        {{ '@' . $user->username }}
                                    </td>

                                    <!-- Role badge -->
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $roleClasses }} whitespace-nowrap">
                                            {{ $user->role->label() }}
                                        </span>
                                    </td>

                                    <!-- Status indicator -->
                                    <td class="py-4 px-6">
                                        @if($user->status === 'active')
                                            <span class="inline-flex items-center space-x-1.5 text-emerald-700 bg-emerald-50/60 border border-emerald-200/60 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                <span>Hoạt động</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center space-x-1.5 text-rose-700 bg-rose-50/60 border border-rose-200/60 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                                <span>Bị Khóa</span>
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Joining date -->
                                    <td class="py-4 px-6 text-slate-400 font-mono font-normal whitespace-nowrap">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>

                                    <!-- Action Controls -->
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center space-x-1">
                                            <!-- Edit Account -->
                                            <button @click="openEditModal({{ json_encode($user) }})" 
                                                    type="button" 
                                                    title="Chỉnh sửa tài khoản"
                                                    class="p-1.5 border border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.586 2.586L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                </svg>
                                            </button>

                                            <!-- Reset Password -->
                                            <button @click="openResetPasswordModal({{ json_encode($user) }})" 
                                                    type="button"
                                                    title="Đặt lại mật khẩu"
                                                    class="p-1.5 border border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"></path>
                                                </svg>
                                            </button>

                                            <!-- Status toggle (active / lock) -->
                                            @if($user->id !== Auth::id())
                                                <form action="{{ route('users.toggle-status', $user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @if($user->status === 'active')
                                                        <button type="submit" 
                                                                title="Khóa tài khoản"
                                                                class="p-1.5 border border-slate-200 hover:border-red-200 text-slate-500 hover:text-red-650 hover:bg-red-50/55 rounded-lg transition-all">
                                                            <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <button type="submit" 
                                                                title="Mở khóa tài khoản"
                                                                class="p-1.5 border border-slate-200 hover:border-emerald-200 text-slate-500 hover:text-emerald-700 hover:bg-emerald-50/55 rounded-lg transition-all">
                                                            <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                @endif

                                                <!-- Delete account -->
                                                @if($user->id !== Auth::id())
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                title="Xóa tài khoản"
                                                                class="p-1.5 border border-slate-200 hover:border-rose-250 text-slate-500 hover:text-rose-600 hover:bg-rose-50/50 rounded-lg transition-all">
                                                            <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab 2: Premium Role & Permission Matrix -->
        <div x-show="activeTab === 'matrix'" x-transition>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-200/60 bg-slate-50/35">
                    <h3 class="text-sm font-bold text-slate-800">Ma trận quyền hạn truy cập</h3>
                    <p class="text-xs text-slate-500 mt-1">Bảng phân bổ chi tiết các tính năng nghiệp vụ được phép thao tác của từng vai trò</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px] whitespace-nowrap">
                                <th class="py-4 px-6 w-1/3">Phân hệ nghiệp vụ</th>
                                <th class="py-4 px-6 text-center">Chủ trại</th>
                                <th class="py-4 px-6 text-center">Kỹ thuật viên</th>
                                <th class="py-4 px-6 text-center">Thủ kho</th>
                                <th class="py-4 px-6 text-center">Kế toán</th>
                                <th class="py-4 px-6 text-center">Thu hoạch</th>
                                <th class="py-4 px-6 text-center font-bold text-indigo-700">Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                            <tr class="hover:bg-slate-50/20 whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-800">Cấu hình Khu nuôi & Ao nuôi</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/20 whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-800">Quản lý Chỉ số nước & Nhật ký ao</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/20 whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-800">Kho vật tư & Nguyên liệu thức ăn</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center border-emerald-100">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/20 whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-800">Thu chi & Chi phí vận hành</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/20 whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-800">Kế hoạch thu hoạch & Bán tôm</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/20 bg-slate-50/5 whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-800">Quản lý Tài khoản & Phân quyền</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center text-slate-300">-</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold">✓</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Alpine.js Create / Edit Modal -->
        <div x-show="showModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <div @click.away="showModal = false" 
                 class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200/60 transform transition-all overflow-hidden"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-200/60 mb-6">
                    <h3 class="text-base font-bold text-slate-900" x-text="isEdit ? 'Chỉnh sửa tài khoản' : 'Tạo tài khoản mới'"></h3>
                    <button @click="showModal = false" class="p-1.5 hover:bg-slate-100 text-slate-400 hover:text-slate-950 rounded-lg transition-colors">
                        <svg class="w-5 h-5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="POST" :action="isEdit ? '/users/' + modalData.id : '{{ route('users.store') }}'" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Họ và tên</label>
                        <input type="text" name="name" x-model="modalData.name" placeholder="Nguyễn Văn A" required
                               class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Username</label>
                            <input type="text" name="username" x-model="modalData.username" placeholder="vana" required
                                   class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Email</label>
                            <input type="email" name="email" x-model="modalData.email" placeholder="vana@example.com" required
                                   class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                        </div>
                    </div>

                    <!-- Password only shown on creation -->
                    <div x-show="!isEdit">
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Mật khẩu</label>
                        <input type="password" name="password" placeholder="Tối thiểu 6 ký tự" ::required="!isEdit" x-model="modalData.password"
                               class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Vai trò truy cập</label>
                            <select name="role" x-model="modalData.role" required
                                    class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                                <option value="owner">Chủ trại nuôi</option>
                                <option value="technician">Kỹ thuật viên</option>
                                <option value="warehouse_staff">Nhân viên kho</option>
                                <option value="accountant">Kế toán</option>
                                <option value="harvester">Người thu hoạch</option>
                                <option value="system_admin">Admin hệ thống</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Trạng thái hoạt động</label>
                            <select name="status" x-model="modalData.status" required
                                    class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                                <option value="active">Đang hoạt động</option>
                                <option value="inactive">Đã khóa</option>
                            </select>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2.5 justify-end pt-4 border-t border-slate-200/60 mt-6">
                        <button @click="showModal = false" type="button"
                                class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                            Hủy bỏ
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all">
                            Lưu tài khoản
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alpine.js Reset Password Modal -->
        <div x-show="showResetPasswordModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <div @click.away="showResetPasswordModal = false" 
                 class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200/60 transform transition-all overflow-hidden"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-200/60 mb-6">
                    <h3 class="text-base font-bold text-slate-900 flex items-center space-x-2">
                        <svg class="w-4 h-4 stroke-[1.75] text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"></path>
                        </svg>
                        <span>Đổi mật khẩu tài khoản</span>
                    </h3>
                    <button @click="showResetPasswordModal = false" class="p-1.5 hover:bg-slate-100 text-slate-400 hover:text-slate-950 rounded-lg transition-colors">
                        <svg class="w-5 h-5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="POST" :action="'/users/' + resetPasswordData.id + '/reset-password'" class="space-y-4">
                    @csrf
                    
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/50 mb-2">
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">Tài khoản</span>
                        <span class="text-sm font-bold text-slate-800" x-text="resetPasswordData.name"></span>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Mật khẩu mới</label>
                        <input type="password" name="password" placeholder="Tối thiểu 6 ký tự" required x-model="resetPasswordData.password"
                               class="w-full bg-slate-50/50 border border-slate-200 p-2.5 text-xs focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all">
                    </div>

                    <div class="flex space-x-2.5 justify-end pt-4 border-t border-slate-200/60 mt-6">
                        <button @click="showResetPasswordModal = false" type="button"
                                class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                            Hủy bỏ
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all font-bold">
                            Đặt lại mật khẩu
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>

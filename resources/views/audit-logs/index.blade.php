<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Nhật ký hoạt động hệ thống
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Overview header -->
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Vết hoạt động (Audit Trail)</h3>
                <p class="text-xs text-slate-500 mt-0.5">Giám sát các thao tác chỉnh sửa, tạo mới hoặc xóa trên hệ thống</p>
            </div>
        </div>

        <!-- Audit Trail Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50/60 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100 whitespace-nowrap">
                            <th class="py-4 px-6">Thời gian</th>
                            <th class="py-4 px-6">Người thực hiện</th>
                            <th class="py-4 px-6">Hành động</th>
                            <th class="py-4 px-6">Mô tả chi tiết</th>
                            <th class="py-4 px-6 font-mono">IP Address</th>
                            <th class="py-4 px-6">Trình duyệt / Thiết bị</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($auditLogs as $log)
                            <tr class="hover:bg-slate-50/10">
                                <td class="py-4 px-6 font-mono whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td class="py-4 px-6 font-bold text-slate-800 whitespace-nowrap">
                                    {{ $log->user->name ?? 'Hệ thống' }} ({{ $log->user->username ?? 'system' }})
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-2.5 py-0.5 font-bold rounded-lg text-[10px] uppercase border bg-slate-50 text-slate-700 border-slate-200 whitespace-nowrap">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-500 max-w-xs truncate" title="{{ $log->description }}">
                                    {{ $log->description }}
                                </td>
                                <td class="py-4 px-6 font-mono text-slate-400">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                                <td class="py-4 px-6 text-slate-400 max-w-xs truncate" title="{{ $log->user_agent }}">
                                    {{ $log->user_agent }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 text-sm">Chưa có hoạt động hệ thống nào được ghi nhận.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination links -->
            @if($auditLogs->hasPages())
                <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                    {{ $auditLogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

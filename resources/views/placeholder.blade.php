<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-8">
                    <!-- Header with Badge -->
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                            {!! $icon ?? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>' !!}
                        </div>
                        <div>
                            <span class="px-2.5 py-0.5 text-xs font-semibold text-emerald-800 bg-emerald-100 rounded-full">Module Nghiệp Vụ</span>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $title }}</h3>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-slate-600 text-sm max-w-2xl leading-relaxed mb-8">
                        {{ $description }}
                    </p>

                    <!-- Features Checklist -->
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Các nghiệp vụ chính đang triển khai</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($features as $feature)
                                <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

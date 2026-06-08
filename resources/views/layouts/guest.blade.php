<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AquaControl — Hệ thống Vận hành</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #fafafa;
            }
            .mono {
                font-family: 'JetBrains Mono', monospace;
            }
            .swiss-grid {
                background-size: 20px 20px;
                background-image: linear-gradient(to right, rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                                  linear-gradient(to bottom, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            }
        </style>
    </head>
    <body class="antialiased min-h-screen swiss-grid flex flex-col items-center justify-center p-6">
        <div class="w-full sm:max-w-md">
            <!-- Brand Logo B2B (Softer version) -->
            <div class="flex flex-col items-center mb-8">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-emerald-500 to-sky-500 p-[1.5px] shadow-md shadow-emerald-500/10">
                        <div class="w-full h-full bg-white rounded-[7px] flex items-center justify-center">
                            <svg class="w-4.5 h-4.5 text-[#16a34a]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12c0-3 3-3 3-3s3 3 6 3 6-3 6-3v6s-3 3-6 3-6-3-6-3z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-slate-900 uppercase">AquaControl</span>
                </a>
            </div>

            <!-- Stark Swiss Card Container (Softer) -->
            <div class="w-full bg-white border border-slate-200/80 p-8 shadow-xl shadow-slate-200/60 rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

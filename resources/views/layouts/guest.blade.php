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
                        <div class="w-full h-full bg-white rounded-[7px] flex items-center justify-center p-0.5">
                            <svg class="w-5 h-5" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="shrimp-grad-guest" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#10b981" />
                                        <stop offset="50%" stop-color="#06b6d4" />
                                        <stop offset="100%" stop-color="#3b82f6" />
                                    </linearGradient>
                                </defs>
                                <path d="M6 22C6 14.5 11.5 8 18.5 8C23.5 8 26.5 11 28 14.5" stroke="url(#shrimp-grad-guest)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 24C11.5 21.5 13.5 19 13.5 16C13.5 13 16 11 19 11C21.5 11 23 12.5 24 14" stroke="url(#shrimp-grad-guest)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" opacity="0.85" />
                                <path d="M4 25C5.5 24.5 6 23 5.5 21.5C5 20 6.5 19.5 7.5 20.5" stroke="url(#shrimp-grad-guest)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M28 14.5C29.5 13.5 31 13 32 13" stroke="url(#shrimp-grad-guest)" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M27 12C28.5 9.5 30 8 31 7" stroke="url(#shrimp-grad-guest)" stroke-width="1.5" stroke-linecap="round" opacity="0.75" />
                                <path d="M10 27C14 28.5 18 28.5 22 27" stroke="url(#shrimp-grad-guest)" stroke-width="1.5" stroke-linecap="round" opacity="0.6" />
                                <circle cx="18.5" cy="8" r="1.5" fill="#10b981" />
                                <circle cx="28" cy="14.5" r="1.5" fill="#06b6d4" />
                                <circle cx="13.5" cy="16" r="1.2" fill="#3b82f6" />
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

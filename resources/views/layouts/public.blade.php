<!DOCTYPE html>
<html lang="en" x-data="{
    theme: localStorage.getItem('theme') || 'dark',
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },
    init() {
        if (this.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" x-init="init()" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name')) - Professional Company Profile</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: 'var(--background)',
                        surface: 'var(--surface)',
                        border: 'var(--border)',
                        primary: 'var(--primary)',
                        secondary: 'var(--secondary)',
                        accent: 'var(--accent)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Light Mode */
            --background: #ffffff;
            --surface: #ffffff;
            --border: #e4e4e7;
            --primary: #18181b;
            --secondary: #71717a;
            --accent: #000000;
        }

        .dark {
            /* Dark Mode */
            --background: #0a0a0a;
            --surface: #171717;
            --border: #262626;
            --primary: #ededed;
            --secondary: #a1a1aa;
            --accent: #ffffff;
        }

        body { font-family: 'Inter', sans-serif; }
        
        .gradient-text {
            background: linear-gradient(to right, #ededed, #666666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        html:not(.dark) .gradient-text {
            background: linear-gradient(to right, #000000, #52525b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--background);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }

        .tech-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background-color: #ffffff;
            background-image: radial-gradient(#d4d4d8 1px, transparent 1px);
            background-size: 24px 24px;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
        }

        .dark .tech-bg {
            background-color: #050505;
            background-image: radial-gradient(#333 1px, transparent 1px);
        }

        .tech-glow {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at center, rgba(200, 200, 200, 0.4) 0%, rgba(255,255,255,0) 70%);
            z-index: -2;
            pointer-events: none;
        }

        .dark .tech-glow {
            background: radial-gradient(circle at center, rgba(30, 30, 30, 0.2) 0%, rgba(0,0,0,0) 70%);
        }
    </style>
</head>
<body class="bg-background text-primary min-h-screen flex flex-col relative transition-colors duration-300">
    <!-- Tech Background -->
    <div class="tech-bg"></div>
    <div class="tech-glow"></div>
    
    <!-- Navbar -->
    <nav class="border-b border-border bg-background/80 backdrop-blur-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-xl font-bold tracking-tighter text-primary">
                {{ config('app.name') }}
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="text-secondary hover:text-primary transition-colors">
                <button @click="toggleTheme()" class="p-2 rounded-lg hover:bg-surface border border-border transition-colors" aria-label="Toggle theme">
                    <svg x-show="theme === 'dark'" class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg x-show="theme === 'light'" class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                <!-- Mobile Menu Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg hover:bg-surface border border-border transition-colors" aria-label="Toggle menu">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
            </div>

            <a href="{{ url('/') }}" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2">Home</a>
            <a href="#about" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2">About</a>
            <a href="#services" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2">Services</a>
            <a href="#portfolio" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2">Portfolio</a>
            <a href="#contact" class="text-sm font-medium text-secondary hover:text-primary transition-colors py-2">Contact</a>
            <a href="{{ route('admin.login') }}" class="bg-primary text-background px-4 py-2 rounded-full text-xs font-bold hover:opacity-90 transition-opacity inline-block text-center">
                Admin Login
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-border bg-surface py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <h2 class="text-lg font-bold tracking-tighter text-primary mb-4">{{ config('app.name') }}</h2>
                    <p class="text-sm text-secondary max-w-md">
                        Professional company profile platform built with Laravel. Empowering businesses to showcase their services and portfolios.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-sm font-bold text-primary mb-4">Quick Links</h3>
                    <div class="flex flex-col gap-2 text-sm text-secondary">
                        <a href="#about" class="hover:text-primary transition-colors">About Us</a>
                        <a href="#services" class="hover:text-primary transition-colors">Services</a>
                        <a href="#portfolio" class="hover:text-primary transition-colors">Portfolio</a>
                        <a href="#contact" class="hover:text-primary transition-colors">Contact</a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-sm font-bold text-primary mb-4">Connect</h3>
                    <div class="flex gap-4">
                        <a href="#" class="text-secondary hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-secondary hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="text-secondary hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 16.892c-2.102.144-6.784.144-8.883 0C5.282 16.736 5.017 15.622 5 12c.017-3.629.285-4.736 2.558-4.892 2.099-.144 6.782-.144 8.883 0C18.718 7.264 18.982 8.378 19 12c-.018 3.629-.285 4.736-2.559 4.892zM10 9.658l4.917 2.338L10 14.342V9.658z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-border pt-8 text-center">
                <p class="text-xs text-secondary/70">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>

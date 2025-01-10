<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col">
            <!-- Top Header -->
            <header class="fixed top-0 left-0 right-0 z-40 bg-white shadow-sm">
                @include('layouts.partials.header')
            </header>

            <!-- Navigation -->
            <div class="fixed top-16 left-0 w-64 bottom-0 z-30 bg-gray-50 border-r border-gray-200">
                @include('layouts.partials.navigation')
            </div>

            <!-- Module Sub-header -->
            <div class="fixed top-16 left-64 right-0 z-30 bg-white border-b border-gray-200">
                @include('layouts.partials.module-nav')
            </div>

            <!-- Main Content Area -->
            <main class="flex-1 md:pl-64 pt-32 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    @if(isset($slot))
                        {{ $slot }}
                    @elseif(isset($content))
                        {{ $content }}
                    @else
                        @yield('content')
                    @endif
                </div>
            </main>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>

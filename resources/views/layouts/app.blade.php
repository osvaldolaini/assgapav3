<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <x-favicons></x-favicons>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        @yield('styles')
        <style>.ck-editor__editable_inline {min-height: 400px;}</style>
    </head>
    <body class="font-sans antialiased" >
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('admin.nav-bar')

            @livewire('message-alert')

            <!-- Page Content -->
            <main>
                <div class="drawer lg:drawer-open">
                    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content">
                        <!-- Page content here -->
                        <div class=" m-3 sm:m-4 sm:p-5
                        bg-white rounded-2xl dark:bg-gray-700">
                            {{ $slot }}
                        </div>
                    </div>
                    <div class="drawer-side">
                        <label for="my-drawer-3" class="drawer-overlay"></label>
                        @livewire('admin.side-bar')
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')


        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
        @yield('scripts')
        @yield('push')
    </body>
</html>

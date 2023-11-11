<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <x-favicons></x-favicons>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased bg-gray-800 text-gray-100">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen
        bg-dots-darker bg-center bg-gray-800 text-gray-100 selection:bg-red-500 selection:text-white">

        <section class="bg-gray-800 text-gray-100">
            <div class="flex flex-row">

                <div
                    class="container mx-auto flex flex-col items-center
                px-4 pt-8 sm:py-16 text-center md:py-32 md:px-10 lg:px-14 xl:max-w-3xl">
                    <div class="block sm:hidden">
                        <x-application-logo></x-application-logo>
                    </div>

                    <h1 class="text-4xl font-bold leading-none sm:text-5xl">Sistema de gestão
                        <span class="text-blue-400">ASSGAPA</span>
                    </h1>

                    <div class="flex flex-wrap justify-center">
                        @auth
                            <a
                                href="{{ route('dashboard') }}"class="px-8 py-3 mx-2 mt-10 text-lg border rounded text-gray-50 border-gray-700">Dashboard</a>
                        @else
                            <a
                                href="{{ route('dashboard') }}"class="px-8 py-3 mx-2 mt-10 text-lg border rounded text-gray-50 border-gray-700">Entrar</a>
                        @endauth

                    </div>
                </div>

            </div>

        </section>

    </div>

    @livewireScripts
</body>

</html>

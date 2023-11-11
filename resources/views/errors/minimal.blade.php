<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>@yield('title')</title>
    <x-favicons></x-favicons>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">

    <section class="flex items-center h-full p-16 dark:bg-gray-900 dark:text-gray-100">
        <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" aria-label="Ir para homepage">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>
            </div>
            <div class="max-w-md text-center">

                <h2 class="mb-8 font-extrabold text-9xl dark:text-gray-600">
                    @yield('code')
                </h2>
                <p class="text-2xl font-semibold md:text-3xl">@yield('message')</p>
                <p class="mt-4 mb-8 dark:text-gray-400">Mas não se preocupe, você pode encontrar muitas outras coisas em
                    nossa página inicial.</p>

                <a rel="noopener noreferrer" href="{{ url('') }}" aria-label="Ir para homepage"
                    class="btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.9098 12.3488L14.5198 7.32881C14.4298 7.00881 14.6098 6.67881 14.9198 6.57881L19.8798 4.96881" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.0198 19.7888C17.0198 20.7088 20.2698 18.9288 21.2798 15.8188C22.2898 12.7088 20.6698 9.44882 17.6698 8.53882" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.4198 12.4988H11.4498" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.4198 6.62878H11.4498" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.4198 18.3688H11.4498" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    Volte para a home
                </a>
            </div>
        </div>
        @livewireScripts
</body>

</html>



{{-- @section('message', __('Not Found')) --}}

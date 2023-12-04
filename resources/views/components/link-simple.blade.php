@props(['url', 'active','role','pages'])
<div>
    @isset($role)
        @if (in_array($role,$pages) == true)
            <a href="{{ route($url) }}"
                class="flex items-center justify-start w-full px-4 py-1 my-0
                    font-thin uppercase transition-colors duration-200
                    {{ Request::is($active)
                        ? ' bg-gradient-to-r from-white to-blue-100                                                                                                                                                                                                                                    dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                        : 'dark:text-gray-200 hover:text-blue-500 text-gray-500'
                    }}">
                {{ $slot }}
            </a>
        @endif
    @endisset

</div>

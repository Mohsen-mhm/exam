<nav
    class="z-50 bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-900 w-full top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="{{ url('/') }}" class="flex items-center">
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name', 'Exam') }}</span>
        </a>
        <div class="flex md:order-2">
            @guest
                @if(Route::has('login'))
                    <a href="{{ route('login') }}"
                       class="transition-all text-gray-700 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-transparent dark:text-white dark:hover:text-gray-300 dark:focus:ring-blue-800">
                        Login
                    </a>
                @endif
                @if(Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="transition-all text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Register
                    </a>
                @endif
            @else
                @if(auth()->user()->avatar)
                    <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                         data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                         src="/storage/images/{{ auth()->user()->avatar }}" alt="User dropdown">
                @else
                    <svg class="w-10 h-10 text-gray-400 border border-gray-500 rounded-full cursor-pointer" fill="currentColor" id="avatarButton" type="button"
                         data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd"></path>
                    </svg>
                @endif

                <!-- Dropdown menu -->
                <div id="userDropdown"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div class="truncate">{{ auth()->user()->name }}</div>
                        <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                        <li>
                            <a href="{{ route('profile') }}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <form id="logout" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout').submit();"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                            out</a>

                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>

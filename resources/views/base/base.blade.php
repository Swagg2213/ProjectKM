<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Management</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-gray-100">

    <nav class="bg-white dark:bg-gray-800 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href='/' class="flex items-center space-x-3">
                        <span class="text-2xl font-bold text-yellow-400">PCU Event</span>
                    </a>
                </div>

                @if (Request::routeIs('event.show') || Request::routeIs('event.favorite'))
                    <div class="hidden md:flex flex-1 justify-center max-w-lg mx-8">
                        <form action="" method="GET" class="flex items-center space-x-3 w-full">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search-events"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search Events..." value="{{ request('search') }}">
                            </div>
                            <div class="relative">
                                <select name="category" onchange="this.form.submit()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 min-w-max">
                                    <option value="">Select category</option>
                                    <option value="Seminar" {{ request('category') == 'Seminar' ? 'selected' : '' }}>
                                        Seminar
                                    </option>
                                    <option value="Panitia" {{ request('category') == 'Panitia' ? 'selected' : '' }}>
                                        Kepanitiaan</option>
                                    <option value="Pengmas" {{ request('category') == 'Pengmas' ? 'selected' : '' }}>
                                        Pengmas
                                    </option>
                                    <option value="Bakmi" {{ request('category') == 'Bakmi' ? 'selected' : '' }}>Bakat
                                        Minat</option>
                                    <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                @endif
                {{-- DEBUG ONLY --}}



                <div class="hidden md:block">
                    <div class="flex items-center space-x-2">
                        @if (session('user_role') != 'Admin')
                            <a href="{{ route('event.show') }}"
                                class="h-16 px-3 inline-flex items-center text-sm font-medium border-b-4 transition-all duration-300 ease-in-out {{ Request::routeIs('event.show') ? 'text-yellow-400 border-yellow-400' : 'text-gray-500 dark:text-white border-transparent hover:text-yellow-400 hover:border-yellow-400' }}">Home</a>
                            @if (session('user_role') == 'Pembuat Event')
                                <a href="{{ url('/addEvent') }}"
                                    class="h-16 px-3 inline-flex items-center text-sm font-medium border-b-4 transition-all duration-300 ease-in-out {{ Request::is('addEvent') ? 'text-yellow-400 border-yellow-400' : 'text-gray-500 dark:text-white border-transparent hover:text-yellow-400 hover:border-yellow-400' }}">Create
                                    Event</a>
                            @endif
                            <a href="{{ route('event.favorite') }}"
                                class="h-16 px-3 inline-flex items-center text-sm font-medium border-b-4 transition-all duration-300 ease-in-out {{ Request::routeIs('event.favorite') ? 'text-yellow-400 border-yellow-400' : 'text-gray-500 dark:text-white border-transparent hover:text-yellow-400 hover:border-yellow-400' }}">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="hidden lg:inline">Interested</span>
                            </a>
                        @endif
                        <div class="relative">
                            <button type="button" id="profileDropdownButton" data-dropdown-toggle="profileDropdown"
                                class="h-16 px-3 inline-flex items-center text-sm font-medium border-b-4 transition-all duration-300 ease-in-out {{ Request::is('profile') ? 'text-yellow-400 border-yellow-400' : 'text-gray-500 dark:text-white border-transparent hover:text-yellow-400 hover:border-yellow-400' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="hidden lg:inline ml-1">Profile</span>
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <div id="profileDropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute right-0 mt-2">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="profileDropdownButton">
                                    <li>
                                        <a href="{{ route('profile.show') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Profile
                                        </a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <form method="POST" action="{{ route('auth.logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:hidden">
                    <button type="button"
                        class="bg-white dark:bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 focus:ring-yellow-400"
                        aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                        <span class="sr-only">Open main menu</span>
                        <svg id="menu-open-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="menu-close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <div class="pt-2 pb-3">
                    <form action="" method="GET" class="space-y-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" name="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Events..." value="{{ request('search') }}">
                        </div>
                        <select name="category" onchange="this.form.submit()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select category</option>
                            <option value="Seminar" {{ request('category') == 'Seminar' ? 'selected' : '' }}>Seminar
                            </option>
                            <option value="Panitia" {{ request('category') == 'Panitia' ? 'selected' : '' }}>
                                Kepanitiaan</option>
                            <option value="Pengmas" {{ request('category') == 'Pengmas' ? 'selected' : '' }}>Pengmas
                            </option>
                            <option value="Bakmi" {{ request('category') == 'Bakmi' ? 'selected' : '' }}>Bakat Minat
                            </option>
                            <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                    </form>
                </div>
                @if (session('user_role') != 'Admin')
                <a href="{{ route('event.show') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ Request::routeIs('event.show') ? 'text-yellow-400 bg-gray-100 dark:bg-gray-700' : 'text-gray-600 dark:text-gray-300 hover:text-yellow-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Home</a>
                    @if (session('user_role') == 'Pembuat Event')
                        <a href="{{ url('/addEvent') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ Request::is('addEvent') ? 'text-yellow-400 bg-gray-100 dark:bg-gray-700' : 'text-gray-600 dark:text-gray-300 hover:text-yellow-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">Create
                        Event</a>
                    @endif
                <a href="{{ route('event.favorite') }}"
                    class="flex items-center px-3 py-2 rounded-md text-base font-medium {{ Request::routeIs('event.favorite') ? 'text-yellow-400 bg-gray-100 dark:bg-gray-700' : 'text-gray-600 dark:text-gray-300 hover:text-yellow-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    Interested
                </a>
                @endif

                <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                    <a href="{{ route('profile.show') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 dark:text-gray-300 hover:text-yellow-400 hover:bg-gray-50 dark:hover:bg-gray-700 {{ Request::routeIs('profile.show') ? 'text-yellow-400 bg-gray-100 dark:bg-gray-700' : '' }}">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-400 hover:text-red-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <div class="pt-2 pb-10">
        @if (session('success'))
            <div id="success-message"
                class="fixed top-20 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="error-message"
                class="fixed top-20 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="fixed top-20 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>



    <script>
        setTimeout(function() {
            const successMsg = document.getElementById('success-message');
            const errorMsg = document.getElementById('error-message');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-open-icon');
            const closeIcon = document.getElementById('menu-close-icon');

            mobileMenu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
    </script>

</body>

</html>

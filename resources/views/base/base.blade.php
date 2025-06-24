<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Management</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <nav class="bg-gray-800 dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-700">
        <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href='/events' class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-bold text-yellow-400">PCU Event</span>
            </a>

            <div class="flex items-center space-x-4">
                <form action="" method="GET" class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search-events"
                            class="bg-gray-700 text-white border border-gray-600 rounded-lg pl-10 pr-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                            placeholder="Search events..." value="{{ request('search') }}">
                    </div>
                    <div class="relative">
                        <select name="category" onchange="this.form.submit()"
                            class="bg-gray-700 text-white border border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Categories</option>
                            <option value="Seminar" {{ request('category') == 'Seminar' ? 'selected' : '' }}>Seminar
                            </option>
                            <option value="Panitia" {{ request('category') == 'Panitia' ? 'selected' : '' }}>Kepanitiaan
                            </option>
                            <option value="Pengmas" {{ request('category') == 'Pengmas' ? 'selected' : '' }}>Pengmas
                            </option>
                            <option value="Bakmi" {{ request('category') == 'Bakmi' ? 'selected' : '' }}>Bakat Minat
                            </option>
                            <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-menu">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-700 rounded-lg bg-gray-800 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                    <li>
                        <a href="{{ route('event.show') }}"
                            class="block py-2 px-3 rounded {{ Request::routeIs('event.show') ? 'text-yellow-400 bg-gray-700 md:bg-transparent' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-yellow-400' }}"
                            aria-current="{{ Request::routeIs('event.show') ? 'page' : 'false' }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('/addEvent') }}"
                            class="block py-2 px-3 rounded {{ Request::is('addEvent') ? 'text-yellow-400 bg-gray-700 md:bg-transparent' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-yellow-400' }}"
                            aria-current="{{ Request::is('addEvent') ? 'page' : 'false' }}">Create Event</a>
                    </li>
                    <li>
                        <a href="{{ route('event.favorite') }}"
                            class="block py-2 px-3 rounded {{ Request::routeIs('event.favorite') ? 'text-yellow-400 bg-gray-700 md:bg-transparent' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-yellow-400' }} flex items-center"
                            aria-current="{{ Request::routeIs('event.favorite') ? 'page' : 'false' }}">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Favorite
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/profile') }}"
                            class="block py-2 px-3 rounded {{ Request::is('profile') ? 'text-yellow-400 bg-gray-700 md:bg-transparent' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-yellow-400' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="pt-5 pb-10">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>

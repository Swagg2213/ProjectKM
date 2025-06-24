<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - PCU Event</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Welcome Back!
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Sign in to continue to PCU Event
                </p>
            </div>
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="you@example.com" required>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-300">
                            Password
                        </label>
                        <a href="#" class="text-sm text-orange-600 hover:underline dark:text-orange-500">
                            Forgot Password?
                        </a>
                    </div>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-2 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-orange-600 rounded-lg hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-800 transition-colors">
                        Sign In
                    </button>
                </div>
                <div class="flex items-center justify-center">
                    <span class="h-px flex-1 bg-gray-300 dark:bg-gray-600"></span>
                    <span class="px-4 text-sm text-gray-500 dark:text-gray-400">OR</span>
                    <span class="h-px flex-1 bg-gray-300 dark:bg-gray-600"></span>
                </div>
                <div>
                     <button type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                        <svg class="w-4 h-auto" width="46" height="47" viewBox="0 0 46 47" fill="none">
                            <path d="M46 24.0287C46 22.09 45.8227 20.1918 45.4844 18.361H23.4688V27.2292H36.3713C35.8182 30.2292 34.1312 32.7841 31.625 34.4935V40.2652H39.8248C43.7375 36.657 46 30.8373 46 24.0287Z" fill="#4285F4"/>
                            <path d="M23.4688 47C29.4955 47 34.5714 45.1114 37.6364 42.1488L31.625 36.3771C29.6705 37.7425 26.8364 38.683 23.4688 38.683C17.442 38.683 12.3661 34.8867 10.7161 29.5801H2.38477V35.4745C5.44977 41.5647 13.7812 47 23.4688 47Z" fill="#34A853"/>
                            <path d="M10.7161 29.58C10.2227 28.1146 9.94977 26.58 9.94977 25C9.94977 23.42 10.2227 21.8854 10.7161 20.42L2.38477 14.5255C0.849772 17.6364 0 21.1918 0 25C0 28.8082 0.849772 32.3636 2.38477 35.4745L10.7161 29.58Z" fill="#FBBC05"/>
                            <path d="M23.4688 9.31698C26.5455 9.31698 29.0227 10.4545 30.9545 12.2727L37.7727 5.71818C34.5714 2.76364 29.4955 0 23.4688 0C13.7812 0 5.44977 5.43534 2.38477 14.5255L10.7161 20.42C12.3661 15.1133 17.442 9.31698 23.4688 9.31698Z" fill="#EA4335"/>
                        </svg>
                        Sign in with Google
                    </button>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Don't have an account?
                        <a href="#" class="font-medium text-orange-600 hover:underline dark:text-orange-500">
                            Sign up
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</body>
</html>

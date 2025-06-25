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
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-sm bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-200 px-6 py-4">
                <h1 class="text-lg font-medium text-gray-800 text-center">Login</h1>
            </div>

            <div class="px-6 py-6">
                <form action="{{ route('auth.login.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            E-mail Address
                        </label>
                        <input type="email" id="email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your PETRA E-mail" required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter password" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                onclick="togglePassword()">
                                <svg id="eye-icon" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-gray-700 hover:bg-gray-800 text-white font-medium py-2.5 px-4 rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Login
                        </button>
                    </div>
                </form>

                <div class="relative flex py-5 items-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="flex-shrink mx-4 text-gray-400 text-sm">Or</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>


                <div class="mt-4 flex flex-col space-y-2">
                    <a href="{{ url('auth/google/redirect/event-creator-role') }}"
                        class="w-full flex items-center justify-center bg-white hover:bg-gray-100 text-gray-700 font-medium py-2.5 px-4 rounded-md text-sm transition-colors duration-200 border border-gray-300 shadow-sm">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.447-2.275,4.481-4.282,5.943l6.19,5.238
                C39.99,35.591,44,29.932,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                        </svg>
                        Sign Up as Event Creator
                    </a>
                    <a href="{{ url('auth/google/redirect/student-role') }}"
                        class="w-full flex items-center justify-center bg-white hover:bg-gray-100 text-gray-700 font-medium py-2.5 px-4 rounded-md text-sm transition-colors duration-200 border border-gray-300 shadow-sm">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                    c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                    c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                    C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                    c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.447-2.275,4.481-4.282,5.943l6.19,5.238
                    C39.99,35.591,44,29.932,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                        </svg>
                        Sign Up as Student
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="success-message"
            class="fixed top-10 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed top-10 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif

    <script>
        setTimeout(function() {
            const successMsg = document.getElementById('success-message');
            const errorMsg = document.getElementById('error-message');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>

</body>

</html>

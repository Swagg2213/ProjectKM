@extends('base.base')

@section('content')
    <div class="min-h-screen bg-gray-100 pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-200 px-6 py-4 rounded-t-lg">
                            <h2 class="text-lg font-semibold text-gray-800">Account Settings</h2>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-gray-900 font-medium">Account Info</a>
                                </li>
                                @if (session('user_role') == 'Pembuat Event')
                                <li>
                                    <a href="{{ route('profile.eventHistory') }}" class="text-gray-500 hover:text-gray-700">Event History</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="lg:w-3/4">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-200 px-6 py-4 rounded-t-lg">
                            <h2 class="text-lg font-semibold text-gray-800">Account Information</h2>
                        </div>
                        <div class="p-8">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-6">Profile Photo</h3>
                                    <div class="flex justify-center">
                                        <div class="relative">
                                            <div
                                                class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden">
                                                @if (isset($user['image']))
                                                    <img src="{{ asset('storage/' . $user['image']) }}"
                                                        alt="Profile Photo" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <label for="image"
                                                class="absolute bottom-0 right-0 bg-gray-600 text-white rounded-full p-1 cursor-pointer hover:bg-gray-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </label>
                                            <input type="file" id="image" name="image" accept="image/*"
                                                class="hidden">
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Information Section -->
                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-6">Profile Information</h3>
                                    <div class="grid grid-cols-1 gap-6">
                                        <div class="flex items-center">
                                            <label for="email"
                                                class="w-32 text-sm font-medium text-gray-700 text-right mr-4">
                                                Email:
                                            </label>
                                            <input type="email" id="email" name="email"
                                                value="{{ $user['email'] ?? '' }}"
                                                class="flex-1 max-w-md px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter email">
                                        </div>

                                        <div class="flex items-center">
                                            <label for="name"
                                                class="w-32 text-sm font-medium text-gray-700 text-right mr-4">
                                                Name:
                                            </label>
                                            <input type="text" id="name" name="name"
                                                value="{{ $user['name'] ?? '' }}"
                                                class="flex-1 max-w-md px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter first name">
                                        </div>

                                        <div class="flex items-center">
                                            <label for="phone"
                                                class="w-32 text-sm font-medium text-gray-700 text-right mr-4">
                                                Phone Number:
                                            </label>
                                            <input type="tel" id="phone" name="phone"
                                                value="{{ $user['phone'] ?? '' }}"
                                                class="flex-1 max-w-md px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter phone number">
                                        </div>

                                        <div class="flex items-center">
                                            <label for="city"
                                                class="w-32 text-sm font-medium text-gray-700 text-right mr-4">
                                                City/Town:
                                            </label>
                                            <input type="text" id="city" name="city"
                                                value="{{ $user['city'] ?? '' }}"
                                                class="flex-1 max-w-md px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter city">
                                        </div>

                                        <div class="flex items-start">
                                            <label for="address"
                                                class="w-32 text-sm font-medium text-gray-700 text-right mr-4 mt-2">
                                                Address:
                                            </label>
                                            <textarea id="address" name="address" rows="3"
                                                class="flex-1 max-w-md px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter address">{{ $user['address'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <button type="submit"
                                        class="bg-gray-700 hover:bg-gray-800 text-white font-medium py-2.5 px-8 rounded-md text-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                        Save My Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.fixed.top-4.right-4');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const photoContainer = document.querySelector('.w-24.h-24');
                    photoContainer.innerHTML =
                        `<img src="${e.target.result}" alt="Profile Photo" class="w-full h-full object-cover rounded-full">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

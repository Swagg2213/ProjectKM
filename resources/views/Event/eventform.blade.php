@extends('base.base')

@section('content')
<div class="min-h-screen pt-28 px-4">
    <div class="w-full max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            @if (session('user_role') != 'Pembuat Event')
            <a href="/events">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M10.5 19.5L3 12l7.5-7.5M3 12h18" />
                </svg>
            </a>
            @endif
            <h1 class="ml-3 text-xl font-bold">Create a New Event</h1>
        </div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('event.add.form') }}"
            class="bg-white p-6 rounded-lg shadow">
            @csrf

            <!-- Event Details -->
            <h2 class="text-lg font-semibold mb-4">Event Details</h2>
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Event Title<span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                </div>

                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Event Category<span class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option disabled selected>Please select one</option>
                        <option value="Seminar">Seminar</option>
                        <option value="Panitia">Kepanitiaan</option>
                        <option value="Pengmas">Pengmas</option>
                        <option value="Bakmi">Bakat Minat</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700" accept="image/*">Upload poster / Image<span class="text-red-500">*</span></label>
                    <input type="file" name="image" id="image" required
                        class="mt-1 block w-full text-sm text-gray-700" />
                </div>

                <div>
                    <label for="link" class="block text-sm font-medium text-gray-700">Event Link / Register</label>
                    <input type="text" name="link" id="link"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                </div>
            </div>

            <!-- Date & Time -->
            <h2 class="text-lg font-semibold mt-8 mb-4">Date & Time</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Start Date<span class="text-red-500">*</span></label>
                    <input type="date" name="date" id="date" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                </div>

                <div>
                    <label for="startTime" class="block text-sm font-medium text-gray-700">Start Time<span class="text-red-500">*</span></label>
                    <input type="time" name="startTime" id="startTime" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                </div>

                <div>
                    <label for="endTime" class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="time" name="endTime" id="endTime"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                </div>
            </div>

            <!-- Location -->
            <h2 class="text-lg font-semibold mt-8 mb-4">Location</h2>
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Where will your event take place?<span class="text-red-500">*</span></label>
                <input type="text" name="lokasi" id="lokasi" required
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
            </div>

            <!-- Additional Information -->
            <h2 class="text-lg font-semibold mt-8 mb-4">Additional Information</h2>
            <div>
                <label for="detail" class="block text-sm font-medium text-gray-700">Event Description<span class="text-red-500">*</span></label>
                <textarea id="detail" name="detail" rows="4" required
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                    placeholder="Describe what's special about your event & other important details."></textarea>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="bg-indigo-700 hover:bg-indigo-900 text-white py-2 px-2 rounded-md font-medium">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

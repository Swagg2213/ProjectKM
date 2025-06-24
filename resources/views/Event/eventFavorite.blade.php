@extends('base.base')

@section('content')
    <div class="container m-auto pt-16">
        <h1 class="text-center font-bold mt-10 text-4xl underline underline-offset-8">Favorite Events</h1>
    </div>

    <div class="container mx-auto px-4 py-8">

        @if ($events->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach ($events as $event)
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 relative">
                        <div class="relative">
                            <a href="{{ url('/event/' . $event->id) }}">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                    class="w-full h-48 object-cover">
                            </a>
                            <div class="absolute top-3 right-3">
                                <form action="{{ route('event.toggleFavorite', $event->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition-colors duration-200">
                                        @if ($event->isFavorite)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="w-5 h-5 text-yellow-400">
                                                <path fill-rule="evenodd"
                                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                            <span
                                class="absolute bottom-3 left-3 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                {{ $event->kategori }}
                            </span>
                        </div>
                        <div class="p-4">
                            <div class="flex items-start mb-3">
                                <div class="text-center mr-4 flex-shrink-0">
                                    <div class="text-xs font-medium text-gray-500 uppercase">
                                        {{ \Carbon\Carbon::parse($event->startTime)->format('M') }}</div>
                                    <div class="text-2xl font-bold text-gray-800">
                                        {{ \Carbon\Carbon::parse($event->startTime)->format('d') }}</div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1 truncate">
                                        <a href="{{ url('/event/' . $event->id) }}"
                                            class="hover:underline">{{ $event->title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-600 truncate">{{ $event->lokasi }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>{{ \Carbon\Carbon::parse($event->startTime)->format('g:i A') }} -
                                    {{ \Carbon\Carbon::parse($event->endTime)->format('g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center text-center py-12 min-h-[40vh]">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h18">
                    </path>
                </svg>
                <p class="text-gray-500 text-lg">No favorite events found matching your criteria.</p>
            </div>
        @endif

        <div class="mt-8">
            {{ $events->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="mt-8">
        {{ $events->appends(request()->query())->links() }}
    </div>
    </div>

    @if (session('success'))
        <div id="success-message" class="fixed top-20 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed top-20 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
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
@endsection

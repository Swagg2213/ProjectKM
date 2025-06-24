@extends('base.base')

@section('content')
    <div class="container m-auto pt-16">
        <h1 class="text-center font-bold mt-10 text-4xl underline underline-offset-8">All Events</h1>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach ($events as $event)
            <a href="{{ route('event.detail', $event->id) }}">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 relative">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                        
                        <div class="absolute top-3 right-3">
                            <form action="{{ route('event.toggleFavorite', $event->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition-colors duration-200">
                                    @if($event->isFavorite)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-yellow-400">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 hover:text-yellow-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5Z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                        
                        <span class="absolute bottom-3 left-3 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                            {{ $event->kategori }}
                        </span>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex items-start mb-3">
                            <div class="text-center mr-4 flex-shrink-0">
                                <div class="text-xs font-medium text-gray-500 uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                <div class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1 truncate">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600 truncate">{{ $event->lokasi }}</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ \Carbon\Carbon::parse($event->startTime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->endTime)->format('g:i A') }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
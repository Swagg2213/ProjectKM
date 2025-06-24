@extends('base.base')

@section('content')
<div class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="mb-8">
            <a href='/events' class="inline-flex items-center text-gray-600 hover:text-orange-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to All Events
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-12">

            <div class="lg:col-span-2 mb-10 lg:mb-0">
                <span class="inline-block bg-orange-500 text-white text-xs font-medium mb-4 px-3 py-1 rounded-full">
                    {{ $event->kategori }}
                </span>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $event->title }}
                </h1>
                
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">About this Event</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($event->detail)) !!}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Poster for {{ $event->title }}" class="w-full h-auto object-cover">
                        
                        <div class="p-6 space-y-4">
                            <div class="flex items-start">
                                <div class="text-center mr-4 flex-shrink-0">
                                    <div class="text-xs font-medium text-gray-500 uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                    <div class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1 truncate">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-600 truncate">{{ \Carbon\Carbon::parse($event->startTime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->endTime)->format('g:i A') }}</p>
                                </div>
                            </div>

                            <hr>
                            
                             <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>{{ $event->lokasi }}</span>
                            </div>

                            @php
                                use Illuminate\Support\Str;
                                $link = Str::startsWith($event->link, ['http://', 'https://']) ? $event->link : 'https://' . $event->link;
                            @endphp
                            <a href="{{ $link }}" target="_blank" class="w-full flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-transform hover:scale-105">
                                Register Now
                            </a>

                            <form action="{{ route('event.toggleFavorite', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                    @if($event->isFavorite)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-yellow-400">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                        </svg>
                                        Remove from Favorites
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5Z" />
                                        </svg>
                                        Add to Favorites
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<a href="#top" class="fixed bottom-4 right-4 p-3 z-10 border-2 border-gray-300 bg-white hover:bg-gray-100 rounded-full shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-600">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
    </svg>
</a>
@endsection

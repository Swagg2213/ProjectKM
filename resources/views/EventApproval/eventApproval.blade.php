@extends('base.base')

@section('content')
<div class="container mx-auto pt-16 px-4">
    <h1 class="text-center font-bold mt-10 text-4xl underline underline-offset-8">Admin Approval Page</h1>

    {{-- Pending Events Table --}}
    <div class="mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-800 text-white sticky top-0 z-10">
            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 px-6 py-4 font-semibold text-sm uppercase tracking-wide">
                <div class="text-center">Submit Date</div>
                <div class="text-center">Event Title</div>
                <div class="text-center">Status</div>
                <div class="text-center">Review</div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse ($events as $event)
            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 items-center px-6 py-5 hover:bg-gray-50 transition-colors duration-150">
                <div class="text-center text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($event->created_at)->format('d/m/Y') }}
                </div>

                <div class="text-center">
                    <p class="text-sm font-medium text-gray-800">{{ $event->title }}</p>
                    <p class="text-xs text-gray-500">{{ $event->kategori }}</p>
                </div>

                <div class="text-center">
                    @php
                        $statusStyles = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'approved' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $statusStyles[$event->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <div class="text-center">
                    <a href="{{ route('event.review', $event->id) }}"
                       class="inline-block px-4 py-2 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition duration-150">
                        Review
                    </a>
                </div>
            </div>
            @empty
            <div class="p-10 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-lg font-medium">No events pending approval</p>
                <p class="text-sm">All events have been reviewed.</p>
            </div>
            @endforelse
        </div>
    </div>

    @if(isset($events) && $events->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $events->links() }}
    </div>
    @endif

    {{-- Reviewed Events Table --}}
    <h2 class="text-center font-bold mt-20 text-3xl underline underline-offset-8">Reviewed Events</h2>
    <div class="mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-700 text-white sticky top-0 z-10">
            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 px-6 py-4 font-semibold text-sm uppercase tracking-wide">
                <div class="text-center">Submit Date</div>
                <div class="text-center">Event Title</div>
                <div class="text-center">Status</div>
                <div class="text-center">Reviewed Date</div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse ($reviewedEvents as $reviewedEvent)
            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 items-center px-6 py-5 hover:bg-gray-50 transition-colors duration-150">
                <div class="text-center text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($reviewedEvent->created_at)->format('d/m/Y') }}
                </div>

                <div class="text-center">
                    <p class="text-sm font-medium text-gray-800">{{ $reviewedEvent->title }}</p>
                    <p class="text-xs text-gray-500">{{ $reviewedEvent->kategori }}</p>
                </div>

                <div class="text-center">
                    @php
                        $statusStyles = [
                            'approved' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $statusStyles[$reviewedEvent->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($reviewedEvent->status) }}
                    </span>
                </div>

                <div class="text-center text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($reviewedEvent->updated_at)->format('d/m/Y H:i') }}
                </div>
            </div>
            @empty
            <div class="p-10 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <p class="text-lg font-medium">No events have been reviewed yet.</p>
                <p class="text-sm">Once an event is approved or rejected, it will appear here.</p>
            </div>
            @endforelse
        </div>
    </div>

    @if(isset($reviewedEvents) && $reviewedEvents->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $reviewedEvents->links() }}
    </div>
    @endif
</div>
@endsection
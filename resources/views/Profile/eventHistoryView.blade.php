@extends('base.base')

@section('content')

    <div class="min-h-screen bg-gray-100 pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-200 px-6 py-4 rounded-t-lg">
                            <h2 class="text-lg font-semibold text-gray-800">Account Settings</h2>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-gray-900">Account
                                        Info</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.eventHistory') }}" class="font-medium text-gray-900">Event
                                        History</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="lg:w-3/4">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-200 px-6 py-4 rounded-t-lg">
                            <h2 class="text-lg font-semibold text-gray-800">Account Event History</h2>
                        </div>
                        <div class="p-8">
                            @if ($events->isEmpty())
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No Events Found</h3>
                                    <p class="mt-1 text-sm text-gray-500">You have not created or participated in any events
                                        yet.</p>
                                </div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach ($events as $event)
                                        <div
                                            class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                            <div class="relative">
                                                <a href="{{ route('event.detail', $event->id) }}">
                                                    <img class="w-full h-48 object-cover"
                                                        src="{{ asset('storage/' . $event->image) ?? 'https://placehold.co/600x400/cccccc/ffffff?text=Event' }}"
                                                        alt="Cover image for {{ $event->title }}"
                                                        onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/ffffff?text=Event';">
                                                </a>
                                                @php
                                                    $statusConfig = [
                                                        'Pending' => ['class' => 'bg-blue-500', 'text' => 'Pending'],
                                                        'Approved' => ['class' => 'bg-green-500', 'text' => 'Approved'],
                                                        'On going' => ['class' => 'bg-yellow-500', 'text' => 'On going'],
                                                        'Completed' => ['class' => 'bg-gray-600', 'text' => 'Completed'],
                                                        'Rejected' => ['class' => 'bg-red-600', 'text' => 'Rejected'],
                                                        'Unknown' => ['class' => 'bg-black', 'text' => 'Unknown'],
                                                    ];
                                                    
                                                    $statusKey = $event->dynamic_status;
                                                    $currentStatus =
                                                        $statusConfig[$statusKey] ?? $statusConfig['Unknown'];
                                                @endphp
                                                <span
                                                    class="absolute bottom-3 left-3 text-xs font-semibold text-white px-3 py-1 rounded-full {{ $currentStatus['class'] }}">
                                                    {{ $currentStatus['text'] }}
                                                </span>
                                            </div>

                                            <div class="p-4">
                                                <div class="flex items-start mb-3">
                                                    <div class="text-center mr-4 flex-shrink-0">
                                                        <div class="text-xs font-medium text-gray-500 uppercase">
                                                            {{ \Carbon\Carbon::parse($event->startTime)->format('M') }}
                                                        </div>
                                                        <div class="text-2xl font-bold text-gray-800">
                                                            {{ \Carbon\Carbon::parse($event->startTime)->format('d') }}
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex justify-between items-start mb-1">
                                                            <a href="{{ route('event.detail', $event->id) }}" class="flex-1">
                                                                <h3 class="text-lg font-semibold text-gray-800 truncate pr-2 hover:text-yellow-500">
                                                                    {{ $event->title }}
                                                                </h3>
                                                            </a>
                                                            <div class="flex-shrink-0 flex items-center space-x-2">
                                                                <a href="{{ route('event.edit.form', $event->id) }}"
                                                                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md text-xs transition-colors duration-300"
                                                                    title="Edit Event">
                                                                    Edit
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <p class="text-sm text-gray-600 truncate">
                                                            {{ $event->lokasi }}</p>
                                                    </div>
                                                </div>

                                                <div class="flex justify-between items-center text-sm text-gray-500">
                                                    <span>{{ \Carbon\Carbon::parse($event->startTime)->format('g:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($event->endTime)->format('g:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-10">
                                    {{ $events->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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
            if (successMsg) {
                successMsg.style.transition = 'opacity 0.5s';
                successMsg.style.opacity = '0';
                setTimeout(() => successMsg.remove(), 500);
            }
            if (errorMsg) {
                errorMsg.style.transition = 'opacity 0.5s';
                errorMsg.style.opacity = '0';
                setTimeout(() => errorMsg.remove(), 500);
            }
        }, 3000);
    </script>

@endsection
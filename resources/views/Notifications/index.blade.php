@extends('base.base')

@section('content')
<div class="container mx-auto pt-16 px-4">
    <h1 class="text-center font-bold mt-10 text-4xl underline underline-offset-8">Notifications</h1>

    <div class="max-w-4xl mx-auto mt-10">
        @forelse ($reviews as $review)
            <div class="bg-white shadow-lg rounded-lg mb-6 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Event Reviewed</p>
                            <h2 class="text-xl font-semibold text-gray-800 hover:text-yellow-500">
                                <a href="{{ route('event.detail', $review->event->id) }}">
                                    {{ $review->event->title }}
                                </a>
                            </h2>
                        </div>
                        <div class="text-right">
                             @if ($review->event->status == 'approved')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif ($review->event->status == 'rejected')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $review->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    @if($review->review)
                    <div class="mt-4 border-t pt-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Admin's Review:</p>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 whitespace-pre-line">{{ $review->review }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                 <div class="bg-gray-50 px-6 py-3">
                    <a href="{{ route('event.edit.form', $review->event->id) }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-800">
                        View or Edit Your Event &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-lg shadow-md">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No Notifications</h3>
                <p class="mt-1 text-sm text-gray-500">You have no new notifications at this time.</p>
            </div>
        @endforelse

        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection
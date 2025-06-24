@extends('base.base')

@section('content')
    
    <div class="container m-auto pt-16">
        <div class="flex justify-center items-center mb-6 mt-10 space-x-4">
            <a href="{{ route('event.approval') }}" class="text-gray-600 hover:text-orange-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h1 class="text-center font-bold text-4xl underline underline-offset-8">Event Review</h1>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="md:flex">

                    <div class="md:w-1/2">
                        <img src="{{ asset('storage/' . $event->image) }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-64 md:h-full object-cover">
                    </div>

                    <div class="md:w-1/2 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ $event->kategori }}
                            </span>
                            <span class="text-sm text-gray-500">
                                Submitted: {{ \Carbon\Carbon::parse($event->created_at)->format('M d, Y') }}
                            </span>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $event->title }}</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($event->date)->format('l, F d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($event->startTime)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->endTime)->format('g:i A') }}</span>
                            </div>
                            
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $event->lokasi }}</span>
                            </div>
                            
                            @if($event->organizer)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Organized by: {{ $event->organizer }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <span class="text-sm font-medium text-gray-700">Current Status: </span>
                            @if($event->status === 'pending')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    Pending Review
                                </span>
                            @elseif($event->status === 'approved')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif($event->status === 'rejected')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($event->detail)
                <div class="px-6 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Event Detail</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 whitespace-pre-line">{{ $event->detail }}</p>
                    </div>
                </div>
                @endif
            </div>

            @if($event->status === 'pending')
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Review This Event</h3>

                <form id="reviewForm" action="{{ route('event.review', $event->id) }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Review Decision</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="action" value="approve" class="sr-only" onchange="toggleReviewSection()">
                                <div class="review-option bg-green-50 border-2 border-green-200 rounded-lg p-4 cursor-pointer hover:bg-green-100 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-green-900">Approve Event</p>
                                            <p class="text-xs text-green-700">This event meets all requirements</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="flex items-center">
                                <input type="radio" name="action" value="reject" class="sr-only" onchange="toggleReviewSection()">
                                <div class="review-option bg-red-50 border-2 border-red-200 rounded-lg p-4 cursor-pointer hover:bg-red-100 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-900">Reject Event</p>
                                            <p class="text-xs text-red-700">This event needs modifications</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div id="reviewSection" class="hidden mb-6">
                        <label for="review" class="block text-sm font-medium text-gray-700 mb-2">
                            Review Comments <span class="text-red-500">*</span>
                        </label>
                        <textarea name="review" 
                                  id="review" 
                                  rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Please provide detailed feedback about why this event is being rejected. Include specific areas that need improvement or requirements that aren't met."></textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            Be specific and constructive in your feedback to help the event organizer improve their submission.
                        </p>
                    </div>
                    
                    <div id="approvalCommentSection" class="hidden mb-6">
                        <label for="approval_comment" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Comments (Optional)
                        </label>
                        <textarea name="approval_comment" 
                                  id="approval_comment" 
                                  rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Add any additional comments or suggestions for the approved event (optional)."></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('event.approval') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                id="submitButton"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
            @endif

            @if($event->reviews && $event->reviews->count() > 0)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Previous Reviews</h3>
                <div class="space-y-4">
                    @foreach($event->reviews as $review)
                    <div class="border-l-4 border-gray-200 pl-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $review->user->name ?? 'Admin' }}</span>
                            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y \a\t g:i A') }}</span>
                        </div>
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $review->review }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
        .review-option input[type="radio"]:checked + div {
            border-color: currentColor;
            background-color: rgba(59, 130, 246, 0.05);
        }
        
        .review-option:has(input[type="radio"]:checked) {
            border-color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.05);
        }
    </style>

    <script>
        function toggleReviewSection() {
            const action = document.querySelector('input[name="action"]:checked')?.value;
            const reviewSection = document.getElementById('reviewSection');
            const approvalCommentSection = document.getElementById('approvalCommentSection');
            const submitButton = document.getElementById('submitButton');
            const reviewTextarea = document.getElementById('review');
            
            if (action === 'reject') {
                reviewSection.classList.remove('hidden');
                approvalCommentSection.classList.add('hidden');
                reviewTextarea.required = true;
            } else if (action === 'approve') {
                reviewSection.classList.add('hidden');
                approvalCommentSection.classList.remove('hidden');
                reviewTextarea.required = false;
            }
            
            submitButton.disabled = !action;
        }
        
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            const action = document.querySelector('input[name="action"]:checked')?.value;
            const reviewText = document.getElementById('review').value.trim();
            
            if (action === 'reject' && !reviewText) {
                e.preventDefault();
                alert('Please provide review comments when rejecting an event.');
                document.getElementById('review').focus();
                return false;
            }
            
            const confirmMessage = action === 'approve' 
                ? 'Are you sure you want to approve this event?' 
                : 'Are you sure you want to reject this event?';
                
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                return false;
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            const radioInputs = document.querySelectorAll('input[name="action"]');
            radioInputs.forEach(input => {
                input.addEventListener('change', function() {
                    document.querySelectorAll('.review-option').forEach(option => {
                        option.classList.remove('ring-2', 'ring-blue-500');
                    });
                    
                    if (this.checked) {
                        this.nextElementSibling.classList.add('ring-2', 'ring-blue-500');
                    }
                });
            });
        });
    </script>
@endsection
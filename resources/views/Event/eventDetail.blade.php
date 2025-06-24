@extends('base.base')

@section('content')
    <div id="top" class="container m-auto px-24 pt-16 w-full">
        <a href="/"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 mt-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div class="gambar flex justify-center items-center pt-3 mt-10">
            <img src="{{ asset('storage/' . $event->image) }}" height="800" width="900" alt="Poster acara">
        </div>
        <div class="judul mb-10">
            <h1 class="text-center font-bold mt-5 text-6xl">{{ $event->title }}</h1>
        </div>
        <div class="flex flex-row w-full ml-35 gap-50 text-center mb-10">
            <div>
                <p class="basis-64 font-extrabold text-4xl">Date And Time</p>
                <h1 class="text-2xl">{{ date('d F Y', strtotime($event->date)) }}</h1>
                <p class="text-xl">{{ $event->startTime }} - {{ $event->endTime }}</p>

            </div>
            <div>
                <p class="basis-64 font-extrabold text-4xl">Location</p>
                <h1 class="text-2xl">{{ $event->lokasi }}</h1>
            </div>
            <div>
                <p class="basis-64 font-extrabold text-4xl ">Registration</p>
                <h1 class="text-2xl">{{ $event->link }}</h1>
            </div>
        </div>
        <div class="isi">
            <p class=" font-bold text-2xl">Event Description</p>
            <div class="paragraf text-justify pt-2 pb-8 text-xl">
                {{ $event->detail }}
            </div>
        </div>
    </div>

    <!-- Back to top button -->
    <a href="#top"
        class="fixed bottom-4 right-4 p-3 z-10 border-2 border-[#125098] bg-white hover:bg-blue-100 rounded-full shadow-md">
        <img src="{{ asset('images/arrow-up-no-bg.png') }}" alt="back to top button" class="w-5 h-5">
    </a>
@endsection

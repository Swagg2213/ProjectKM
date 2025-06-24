@extends('base.base')

@section('content')
    <div class="container m-auto pt-16">
        <h1 class="text-center font-bold mt-10 text-4xl underline underline-offset-8">All Event</h1>
    </div>

    <div class="container flex flex-wrap justify-center px-14 py-10 ml-35 text-center grid grid-cols-3 gap-8">
        @foreach ($events as $event)
            <div
                class="bg-white dark:bg-slate-800 rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl w-80 flex flex-col">
                <div class = "w-full h-1/2 flex justify-center">
                    <img src="{{ asset('storage/' . $event->image) }}" height="600" width="600">
                </div>
                <div>
                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5">
                            <path fill-rule="evenodd"
                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>
                <h5 class="text-slate-700 font-bold text-xl mt-2 py-2">{{ $event->title }}</h5>
                <h6 class="text-slate-700 font-bold my-1">{{ $event->startTime }} - {{ $event->endTime }}</h6>
                <h6 class="text-slate-700 font-bold my-1">{{ $event->lokasi }}</h6>
                <p class="text-center text-slate-500 my-1">
                    {{ Str::limit($event->detail, 200) }}
                </p>

                <div class="mt-auto pt-5 flex items-center justify-center">
                    <a href="/event/{{ $event->id }}"
                        class="rounded-md bg-indigo-500 hover:bg-indigo-600 px-3 py-3 text-sm font-semibold text-white">Klik
                        untuk membaca!</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

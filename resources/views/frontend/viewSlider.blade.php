@extends('layouts.layout')

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid gap-8 lg:grid-cols-2 xl:grid-cols-3">
        @foreach ($sliders as $slider)
            <div
                class="bg-white rounded-2xl shadow-lg border overflow-hidden hover:shadow-2xl transition duration-300 ease-in-out">

                <div class="w-full h-64 md:h-96 overflow-hidden">
                    <img src="{{ $slider['image_url'] }}" alt="{{ $slider['header'] ?? 'Slide Image' }}"
                        class="w-full h-full object-cover object-center transform hover:scale-105 transition duration-500 ease-in-out">
                </div>

                <div class="p-8 md:p-10 lg:p-12">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2 border-l-4 border-blue-500 pl-4">
                        {{ $slider['header'] ?? '' }}
                    </h2>
                    <p class="text-gray-700 text-lg md:text-xl leading-relaxed tracking-wide whitespace-pre-line p-4">
                        {!! nl2br(e($slider['common_header'] ?? '')) !!}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('about') }}"
                            class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                            Learn More About Us
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </section>
@endsection

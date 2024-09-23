@extends('layouts.app')

@push('content')
  <!-- Card Blog -->
  @if(count($posts) > 0)
    <div class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <!-- Title -->
        <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
        <h2 class="text-2xl font-bold dark:text-white md:text-4xl md:leading-tight">The Blog</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-400">See how game-changing companies are making the most of every
            engagement with Preline.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <a class="group flex h-full flex-col rounded-xl border border-gray-200 p-5 transition duration-300 hover:border-transparent hover:shadow-lg focus:border-transparent focus:shadow-lg focus:outline-none dark:border-gray-700 dark:hover:border-transparent dark:hover:shadow-black/40 dark:focus:border-transparent dark:focus:shadow-black/40"
            href="{{ route('show-post', ['slug' => $post->slug, 'id' => $post->id]) }}">
            <div class="aspect-w-16 aspect-h-11">
                <img class="w-full max-h-48 rounded-xl object-cover"
                src="{{ asset_path($post->banner) }}"
                alt="Blog Image">
            </div>
            <div class="my-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 dark:group-hover:text-white">
                {{ $post->title }}
                </h3>
                <p class="mt-5 text-gray-600 dark:text-gray-400">
                {{ Str::limit($post->short_description, 120) }}
                </p>
            </div>
            <div class="mt-auto flex items-center gap-x-3">
                <img class="size-8 rounded-full"
                src="{{ asset_path($post->author->profile_photo_path) }}"
                alt="Avatar">
                <div>
                <h5 class="text-sm text-gray-800 dark:text-gray-200">By <span class="capitalize">{{ $post->author->name }}</span></h5>
                </div>
            </div>
            </a>
        @endforeach

        </div>
        <!-- End Grid -->

        <!-- Card -->
        <div class="mt-12 text-center">
        <a class="inline-flex items-center gap-x-1 rounded-full border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-blue-600 shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-blue-500 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
            href="#">
            Read more
            <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
            </svg>
        </a>
        </div>
        <!-- End Card -->
    </div>
  @endif
  <!-- End Card Blog -->
@endpush

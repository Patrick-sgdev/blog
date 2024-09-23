@extends('dashboard.layouts.dashboard')

@push('content')
  <a href="{{ route('dashboard.posts') }}"
    class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700 uppercase">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left">
      <path d="M6 8L2 12L6 16" />
      <path d="M2 12H22" />
    </svg>

    {{ trans('back to posts') }}

  </a>

  <livewire:post-livewire :post="$post" />
@endpush

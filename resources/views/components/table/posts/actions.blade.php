@props(['value'])

<div class="hs-dropdown relative inline-block [--placement:bottom-right]">
  <button id="hs-table-dropdown-3" type="button"
    class="hs-dropdown-toggle focus:ring-primary-dark inline-flex items-center justify-center gap-2 rounded-md px-2 py-1.5 align-middle text-sm text-gray-700 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
      viewBox="0 0 16 16">
      <path
        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
    </svg>
  </button>
  <div
    class="hs-dropdown-menu duration z-10 mt-2 hidden divide-y divide-gray-200 rounded-lg bg-white p-2 opacity-0 shadow-2xl transition-[opacity,margin] hs-dropdown-open:opacity-100 dark:divide-gray-700 dark:border dark:border-gray-700 dark:bg-gray-800 min-w-[13rem]"
    aria-labelledby="hs-table-dropdown-3">
    <div class="py-2 first:pt-0 last:pb-0">
      <a class="focus:ring-primary-main flex items-center gap-x-3 rounded-md px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
        href="{{ route('dashboard.get-post', ['post' => $value]) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
        {{ trans('See Post') }}
      </a>
    </div>

    <div class="py-2 first:pt-0 last:pb-0">
      <a class="focus:ring-primary-main flex items-center gap-x-3 rounded-md px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
        href="{{ route('dashboard.post', ['post' => $value]) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-square-pen">
          <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
          <path
            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
        </svg>
        {{ trans('Edit') }}
      </a>
    </div>

    <div class="py-2 first:pt-0 last:pb-0">
      <a class="focus:ring-primary-main flex cursor-pointer items-center gap-x-3 rounded-md px-3 py-2 text-sm text-red-600 hover:bg-gray-100 focus:ring-2 dark:text-red-500 dark:hover:bg-gray-700"
        x-on:click="window.callEvent('showConfirmationAlert', {data: {action: 'deletePost', post: {{ $value }} }, title: '{{ trans('Are you sure you want to delete it?') }}', text: '{{ trans('This action cannot be undone.') }}'})">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-trash-2">
          <path d="M3 6h18" />
          <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
          <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
          <line x1="10" x2="10" y1="11" y2="17" />
          <line x1="14" x2="14" y1="11" y2="17" />
        </svg>
        {{ trans('Delete') }}
      </a>
    </div>
  </div>
</div>

@extends('dashboard.layouts.dashboard')

@push('content')
  <div class="border-b border-gray-200 dark:border-gray-700">
    <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
      <button type="button"
        class="active inline-flex items-center gap-x-2 whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm text-gray-500 hover:text-blue-600 focus:text-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 hs-tab-active:border-blue-600 hs-tab-active:font-semibold hs-tab-active:text-blue-600 dark:text-gray-400 dark:hover:text-blue-500"
        id="tabs-with-underline-item-1" aria-selected="true" data-hs-tab="#tabs-with-underline-1"
        aria-controls="tabs-with-underline-1" role="tab">
        {{ trans('Publicações') }}
      </button>
      <button type="button"
        class="inline-flex items-center gap-x-2 whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm text-gray-500 hover:text-blue-600 focus:text-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 hs-tab-active:border-blue-600 hs-tab-active:font-semibold hs-tab-active:text-blue-600 dark:text-gray-400 dark:hover:text-blue-500"
        id="tabs-with-underline-item-2" aria-selected="false" data-hs-tab="#tabs-with-underline-2"
        aria-controls="tabs-with-underline-2" role="tab">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-plus">
          <path d="M5 12h14" />
          <path d="M12 5v14" />
        </svg> {{ trans('Nova Publicação') }}
      </button>
    </nav>
  </div>

  <div class="mt-3">
    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
      <livewire:posts-table />
    </div>
    <div id="tabs-with-underline-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-underline-item-2">
      <livewire:post-livewire />
    </div>
  </div>

  <script>
    window.addEventListener('alert-confirmed', function(e) {
      if (e.detail.action == 'deletePost') {
        window.callEvent('showLoadingAlert', {
          message: "{{ trans('Por favor aguarde um momento') }}",
          title: "{{ trans('Carregando...') }}"
        })

        Livewire.dispatch('deletePost', {
          'post': e.detail.post,
        });

        return;
      }
    })
  </script>
@endpush

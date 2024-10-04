<div class="py-2">
  <div class="mb-4">
    <label for="hs-validation-name-error-api_key"
      class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Chave API') }} <span
        class="text-red-500">*</span></label>
    <div class="relative">
      <input type="text" id="hs-validation-name-error-api_key" name="hs-validation-name-error-api_key"
        @class([
            'block w-full rounded-lg  px-4 py-3 text-sm  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400',
            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                'api_key'),
        ]) required="" aria-describedby="hs-validation-name-error-api_key-helper"
        wire:model.live.debounce200ms="api_key">
      <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-3">
        @error('api_key')
          <svg class="size-4 shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" x2="12" y1="8" y2="12"></line>
            <line x1="12" x2="12.01" y1="16" y2="16"></line>
          </svg>
        @enderror
      </div>
    </div>
    @error('api_key')
      <p class="mt-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
      </p>
    @enderror
  </div>
  <button type="button"
    class="float-right inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
    id="save-content" wire:loading.class="pointer-events-none opacity-50" wire:click="newKey">
    <span wire:loading.remove>{{ trans('Gerar nova chave') }}</span>
    <span wire:loading>{{ trans('Carregando...') }}</span>
  </button>
</div>

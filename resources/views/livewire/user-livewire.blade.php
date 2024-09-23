<div>
  <div class="mb-4">
    <label for="hs-validation-name-error-name"
      class="mb-2 block text-sm font-medium capitalize dark:text-white">{{ trans('name') }}<span
        class="text-red-500">*</span></label>
    <div class="relative">
      <input type="text" id="hs-validation-name-error-name" name="hs-validation-name-error-name"
        @class([
            'block w-full rounded-lg  px-4 py-3 text-sm  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400',
            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                'name'),
        ]) required="" aria-describedby="hs-validation-name-error-name-helper"
        wire:model.live.debounce200ms="name">
      <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-3">
        @error('name')
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
    @error('name')
      <p class="mt-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
      </p>
    @else
      {{-- <p class="mt-2 text-sm text-gray-500 dark:text-gray-500" id="hs-input-helper-text">{{ trans('min 3 letters, max 255 letters') }}</p> --}}
    @enderror
  </div>

  <div class="mb-4">
    <label for="hs-validation-name-error-email"
      class="mb-2 block text-sm font-medium capitalize dark:text-white">{{ trans('email') }}<span
        class="text-red-500">*</span></label>
    <div class="relative">
      <input type="text" id="hs-validation-name-error-email" name="hs-validation-name-error-email"
        @class([
            'block w-full rounded-lg  px-4 py-3 text-sm  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400',
            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                'email'),
        ]) required="" aria-describedby="hs-validation-name-error-email-helper"
        wire:model.live.debounce200ms="email">
      <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-3">
        @error('email')
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
    @error('email')
      <p class="mt-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
      </p>
    @else
      {{-- <p class="mt-2 text-sm text-gray-500 dark:text-gray-500" id="hs-input-helper-text">{{ trans('min 3 letters, max 255 letters') }}</p> --}}
    @enderror
  </div>

  <div class="mb-4">
    <label for="hs-validation-name-error-password"
      class="mb-2 block text-sm font-medium capitalize dark:text-white">{{ trans('password') }} @if(!$user) <span
      class="text-red-500">*</span> @endif</label>
    <div class="relative">
      <input type="password" id="hs-validation-name-error-password" name="hs-validation-name-error-password"
        @class([
            'block w-full rounded-lg  px-4 py-3 text-sm  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400',
            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                'password'),
        ]) required="" aria-describedby="hs-validation-name-error-password-helper"
        wire:model.live.debounce200ms="password">
      <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-3">
        @error('password')
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
    @error('password')
      <p class="mt-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
      </p>
    @else
      {{-- <p class="mt-2 text-sm text-gray-500 dark:text-gray-500" id="hs-input-helper-text">{{ trans('min 3 letters, max 255 letters') }}</p> --}}
    @enderror
  </div>

  <div class="mb-4">
    <label for="hs-validation-name-error-profile_picture"
      class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Select a profile picture') }} </label>
    <label for="file-input" class="sr-only">Choose file</label>
    <input type="file" name="file-input" id="file-input" wire:model.live="profile_picture"
      class="block w-full rounded-lg border border-gray-200 text-sm shadow-sm file:me-4 file:border-0 file:bg-gray-50 file:px-4 file:py-3 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-400">

    @if ($profile_picture)
      <img src="{{ $profile_picture->temporaryUrl() }}" class="size-32 my-2 rounded-full object-cover">
    @elseif($user)
      <img src="{{ asset_path($user->profile_photo_path) }}" class="size-32 my-2 rounded-full object-cover">
    @endif
  </div>
  @error('profile_picture')
    <p class="mb-2 text-sm text-red-600">{{ $message }}
    </p>
  @enderror

  <div class="mb-4" wire:ignore>
    <label for="hs-validation-name-error-categories"
      class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Roles') }} <span
        class="text-red-500">*</span></label>
    <select multiple wire:model.live="roles"
      data-hs-select='{
          "placeholder": "Select multiple options...",
          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
          "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-gray-700 dark:[&::-webkit-scrollbar-thumb]:bg-gray-500 dark:bg-gray-900 dark:border-gray-700",
          "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-gray-200 dark:focus:bg-gray-800",
          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
          "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
      }'
      class="hidden">
      <option value="">Choose</option>
      @foreach ($rolesArray as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
      @endforeach
    </select>

  </div>
  @error('roles')
    <p class="mb-2 text-sm text-red-600" id="">{{ $message }}
    </p>
  @enderror

  <button type="button"
    class="float-right inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
    id="save-content" wire:click="store" wire:loading.class="pointer-events-none opacity-50">
    <span wire:loading.remove>{{ trans('Save') }}</span>
    <span wire:loading>{{ trans('Loading...') }}</span>
  </button>
</div>
</div>

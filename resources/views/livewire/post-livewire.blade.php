<div>
  <div class="py-2">

    <div class="mb-4">
      <label for="hs-validation-name-error-title"
        class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Title') }} <span
          class="text-red-500">*</span></label>
      <div class="relative">
        <input type="text" id="hs-validation-name-error-title" name="hs-validation-name-error-title"
          @class([
              'block w-full rounded-lg  px-4 py-3 text-sm  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400',
              'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                  'title'),
          ]) required="" aria-describedby="hs-validation-name-error-title-helper"
          wire:model.live.debounce200ms="title">
        <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-3">
          @error('title')
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
      @error('title')
        <p class="mt-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
        </p>
      @else
        {{-- <p class="mt-2 text-sm text-gray-500 dark:text-gray-500" id="hs-input-helper-text">{{ trans('min 3 letters, max 255 letters') }}</p> --}}
      @enderror
    </div>

    <div class="mb-4">
      <label for="hs-validation-name-error-short_description"
        class="mb-2 block text-sm font-medium dark:text-white capitalize">{{ trans('short description') }} <span
          class="text-red-500">*</span></label>
      <div class="relative">
        <input type="text" id="hs-validation-name-error-short_description" name="hs-validation-name-error-short_description"
          @class([
              'block w-full rounded-lg  px-4 py-3 text-sm  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400',
              'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has(
                  'short_description'),
          ]) required="" aria-describedby="hs-validation-name-error-short_description-helper"
          wire:model.live.debounce200ms="short_description">
        <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-3">
          @error('short_description')
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
      @error('title')
        <p class="mt-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
        </p>
      @else
        {{-- <p class="mt-2 text-sm text-gray-500 dark:text-gray-500" id="hs-input-helper-text">{{ trans('min 3 letters, max 255 letters') }}</p> --}}
      @enderror
    </div>

    <div class="mb-4">
      <label for="hs-validation-name-error-banner"
        class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Select a banner') }} @if(!$post) <span
        class="text-red-500">*</span> @endif</label>
      <label for="file-input" class="sr-only">Choose file</label>
      <input type="file" name="file-input" id="file-input" wire:model.live="banner"
        class="block w-full rounded-lg border border-gray-200 text-sm shadow-sm file:me-4 file:border-0 file:bg-gray-50 file:px-4 file:py-3 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-400">

      @if ($banner)
        <img src="{{ $banner->temporaryUrl() }}" class="my-2 max-w-4xl">
      @elseif($post)
        <img src="{{ asset_path($post->banner) }}" class="my-2 max-w-4xl">
      @endif
    </div>
    @error('banner')
      <p class="mb-2 text-sm text-red-600">{{ $message }}
      </p>
    @enderror

    <div class="mb-4" wire:ignore>
      <label for="hs-validation-name-error-categories"
        class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Status') }} <span
          class="text-red-500">*</span></label>
      <select wire:model.live="status"
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
        <option value="draft">{{ trans('Draft') }}</option>
        <option value="published">{{ trans('Publish') }}</option>
      </select>

    </div>
    @error('status')
      <p class="mb-2 text-sm text-red-600" id="">{{ $message }}
      </p>
    @enderror

    <div class="mb-4" wire:ignore>
      <label for="hs-validation-name-error-categories"
        class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Select one or more categories') }} <span
          class="text-red-500">*</span></label>
      <select wire:model.live="categories" multiple=""
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
        @foreach ($categoriesArray as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>

    </div>
    @error('categories')
      <p class="mb-2 text-sm text-red-600" id="">{{ $message }}
      </p>
    @enderror

    <div class="mb-4" wire:ignore>
      <label for="hs-validation-name-error-tags"
        class="mb-2 block text-sm font-medium dark:text-white">{{ trans('Select one or more tags') }}</label>
      <select wire:model.live="tags" multiple=""
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
        @foreach ($tagsArray as $tag)
          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
      </select>
    </div>
    @error('tags')
      <p class="mt-b text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
      </p>
    @enderror

    <div class="mx-auto" wire:ignore>
      <div class="mb-2 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg" wire:ignore>
        <textarea id="open-source-plugins" wire:ignore wire:model.live="content"></textarea>

    </div>
    @error('content')
      <p class="mb-2 text-sm text-red-600" id="hs-validation-name-error-helper">{{ $message }}
      </p>
    @enderror

      <button type="button"
        class="float-right inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
        id="save-content" wire:loading.class="pointer-events-none opacity-50">
        <span wire:loading.remove>{{ trans('Save') }}</span>
        <span wire:loading>{{ trans('Loading...') }}</span>
      </button>
    </div>
  </div>

  <style>
    figure.image {
      display: inline-block;
      border: 1px solid gray;
      margin: 0 2px 0 1px;
      background: #f5f2f0;
    }

    figure.align-left {
      float: left;
    }

    figure.align-right {
      float: right;
    }

    figure.image img {
      margin: 8px 8px 0 8px;
    }

    figure.image figcaption {
      margin: 6px 8px 6px 8px;
      text-align: center;
    }

    img.align-left {
      float: left;
    }

    img.align-right {
      float: right;
    }

    .mce-toc {
      border: 1px solid gray;
    }

    .mce-toc h2 {
      margin: 4px;
    }

    .mce-toc li {
      list-style-type: none;
    }

    .tox-promotion,
    .tox-statusbar__branding,
    .tox-statusbar__help-text {
      display: none !important;
    }

    .tox .tox-statusbar__text-container.tox-statusbar__text-container--flex-start {
      justify-content: space-between;
    }
  </style>

  <script src="{{ asset_path('tinymce/tinymce.js') }}" referrerpolicy="origin"></script>

  <script>
    const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

    tinymce.init({
      selector: '#open-source-plugins',
      plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
      editimage_cors_hosts: ['picsum.photos'],
      menubar: 'file edit view insert format tools table help',
      toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
      autosave_ask_before_unload: false,
      autosave_interval: '30s',
      autosave_prefix: '{path}{query}-{id}-',
      autosave_restore_when_empty: false,
      autosave_retention: '2m',
      image_advtab: true,
      link_list: [],
      image_list: [],
      importcss_append: true,
      file_picker_callback: (callback, value, meta) => {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
          callback('https://www.google.com/logos/google.jpg', {
            text: 'My text'
          });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
          callback('https://www.google.com/logos/google.jpg', {
            alt: 'My alt text'
          });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
          callback('movie.mp4', {
            source2: 'alt.ogg',
            poster: 'https://www.google.com/logos/google.jpg'
          });
        }
      },
      height: 600,
      image_caption: true,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_class: 'mceNonEditable',
      toolbar_mode: 'sliding',
      contextmenu: 'link image table',
      skin: useDarkMode ? 'oxide-dark' : 'oxide',
      content_css: useDarkMode ? 'dark' : 'default',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });

    const saveButton = document.getElementById('save-content');

    saveButton.addEventListener('click', async function(e) {
      e.preventDefault();

      const data = tinymce.activeEditor.getContent({
        format: "html"
      });

      Livewire.dispatch('store', {
        content: data
      })

      //   try {
      //     const response = await fetch("{{ route('create-post') }}", {
      //       method: 'POST',
      //       headers: {
      //         'Content-Type': 'application/json',
      //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      //       },
      //       body: JSON.stringify({
      //         content
      //       })
      //     });

      //     // Check if the request was successful
      //     if (response.ok) {
      //       const responseData = await response.json(); // Extract JSON data from the response
      //       if (responseData.status == 'success') {
      //         window.location.href = `get-post/${responseData.data}`;
      //       }
      //     } else {
      //       console.error('Error saving content.');
      //     }
      //   } catch (error) {
      //     console.error('An error occurred:', error);
      //   } finally {
      //     // Re-enable the button and reset the text
      //     saveButton.disabled = false;
      //     saveButton.textContent = 'Save';
      //   }
    });
  </script>
</div>

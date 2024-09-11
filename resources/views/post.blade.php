<x-app-layout>
    <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Dashboard') }}
      </h2>
    </x-slot>
  
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-2 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
          <textarea id="open-source-plugins">
            {!! $post->content !!}
          </textarea>
        </div>
  
        <button type="button"
          class="float-right inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
          id="save-content">
          {{ trans('Update') }}
        </button>
      </div>
    </div>
  
  </x-app-layout>
  
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
  
      // Disable the button and show loading state
      saveButton.disabled = true;
      saveButton.textContent = 'Loading...';
  
      const content = tinymce.activeEditor.getContent({
        format: "html"
      });
  
      const postId = "{{ $post->id }}";

      try {
        const response = await fetch(`/update-post/${postId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            content
          })
        });
  
        // Check if the request was successful
        if (response.ok) {
          const responseData = await response.json(); // Extract JSON data from the response
          if(responseData.status == 'success') {
              saveButton.textContent = 'Updated';
          }
        } else {
          console.error('Error saving content.');
        }
      } catch (error) {
        console.error('An error occurred:', error);
      } finally {
        // Re-enable the button and reset the text
        saveButton.disabled = false;
        setTimeout(() => {
            saveButton.textContent = 'Update'; 
        }, 2000);
      }
    });
  </script>
  
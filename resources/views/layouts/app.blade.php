<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- <link rel="stylesheet" href="{{ asset_path('build/assets/app.css') }}">
    <script src="{{ asset_path('build/assets/app.js') }}"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
  </head>

  <body class="bg-white dark:bg-gray-800"><!-- ========== HEADER ========== -->
    <header
      class="z-50 flex w-full flex-wrap border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 md:flex-nowrap md:justify-start">
      <nav
        class="relative mx-auto w-full max-w-[85rem] px-4 py-2 sm:px-6 md:flex md:items-center md:justify-between md:gap-3 lg:px-8">
        <!-- Logo w/ Collapse Button -->
        <div class="flex items-center justify-between">
          <a class="flex-none text-xl font-semibold text-black focus:opacity-80 focus:outline-none dark:text-white"
            href="/" aria-label="Brand">BLOG</a>

          <!-- Collapse Button -->
          <div class="md:hidden">
            <button type="button"
              class="hs-collapse-toggle size-9 relative flex items-center justify-center rounded-lg border border-gray-200 text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700"
              id="hs-header-classic-collapse" aria-expanded="false" aria-controls="hs-header-classic"
              aria-label="Toggle navigation" data-hs-collapse="#hs-header-classic">
              <svg class="size-4 hs-collapse-open:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" x2="21" y1="6" y2="6" />
                <line x1="3" x2="21" y1="12" y2="12" />
                <line x1="3" x2="21" y1="18" y2="18" />
              </svg>
              <svg class="size-4 hidden shrink-0 hs-collapse-open:block" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
              </svg>
              <span class="sr-only">Toggle navigation</span>
            </button>
          </div>
          <!-- End Collapse Button -->
        </div>
        <!-- End Logo w/ Collapse Button -->

        <!-- Collapse -->
        <div id="hs-header-classic"
          class="hs-collapse hidden grow basis-full overflow-hidden transition-all duration-300 md:block"
          aria-labelledby="hs-header-classic-collapse">
          <div
            class="max-h-[75vh] overflow-hidden overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-gray-500 [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-gray-700 [&::-webkit-scrollbar]:w-2">
            <div class="flex flex-col gap-0.5 py-2 md:flex-row md:items-center md:justify-end md:gap-1 md:py-0">
              <a class="flex items-center p-2 text-sm text-blue-600 focus:text-blue-600 focus:outline-none dark:text-blue-500 dark:focus:text-blue-500"
                href="#" aria-current="page">
                <svg class="size-4 me-3 block shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                  <path
                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg>
                Landing
              </a>

              <a class="flex items-center p-2 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                href="#">
                <svg class="size-4 me-3 block shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
                Account
              </a>

              <a class="flex items-center p-2 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                href="#">
                <svg class="size-4 me-3 block shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 12h.01" />
                  <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                  <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                  <rect width="20" height="14" x="2" y="6" rx="2" />
                </svg>
                Work
              </a>

              <a class="flex items-center p-2 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                href="#">
                <svg class="size-4 me-3 block shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
                  <path d="M18 14h-8" />
                  <path d="M15 18h-5" />
                  <path d="M10 6h8v4h-8V6Z" />
                </svg>
                Blog
              </a>

              <!-- Dropdown -->
              <div
                class="hs-dropdown [--adaptive:none] [--is-collapse:true] [--strategy:static] md:[--is-collapse:false] md:[--strategy:fixed]">
                <button id="hs-header-classic-dropdown" type="button"
                  class="hs-dropdown-toggle flex w-full items-center p-2 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                  aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                  <svg class="size-4 me-3 block shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 10 2.5-2.5L3 5" />
                    <path d="m3 19 2.5-2.5L3 14" />
                    <path d="M10 6h11" />
                    <path d="M10 12h11" />
                    <path d="M10 18h11" />
                  </svg>
                  Dropdown
                  <svg
                    class="size-4 ms-auto shrink-0 duration-300 hs-dropdown-open:-rotate-180 md:ms-1 md:hs-dropdown-open:rotate-0"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                  </svg>
                </button>

                <div
                  class="hs-dropdown-menu relative top-full z-10 hidden w-full ps-7 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute before:-top-4 before:start-0 before:h-5 before:w-full after:absolute after:start-[18px] after:top-1 after:h-[calc(100%-0.25rem)] after:w-0.5 after:bg-gray-100 hs-dropdown-open:opacity-100 dark:after:bg-gray-700 md:w-52 md:rounded-lg md:bg-white md:ps-0 md:shadow-md md:duration-[150ms] md:after:hidden dark:md:bg-gray-800"
                  role="menu" aria-orientation="vertical" aria-labelledby="hs-header-classic-dropdown">
                  <div class="space-y-0.5 py-1 md:px-1">
                    <a class="flex items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                      href="#">
                      About
                    </a>

                    <div
                      class="hs-dropdown relative [--adaptive:none] [--is-collapse:true] [--strategy:static] md:[--is-collapse:false] md:[--strategy:absolute] md:[--trigger:hover]">
                      <button id="hs-header-classic-dropdown-sub" type="button"
                        class="hs-dropdown-toggle flex w-full items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500">
                        Sub Menu
                        <svg
                          class="size-4 ms-auto shrink-0 duration-300 hs-dropdown-open:-rotate-180 md:-rotate-90 md:hs-dropdown-open:-rotate-90"
                          xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round">
                          <path d="m6 9 6 6 6-6" />
                        </svg>
                      </button>

                      <div
                        class="hs-dropdown-menu relative z-10 hidden ps-7 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute before:-end-5 before:top-0 before:hidden before:h-full before:w-5 after:absolute after:start-[18px] after:top-1 after:h-[calc(100%-0.25rem)] after:w-0.5 after:bg-gray-100 hs-dropdown-open:opacity-100 dark:divide-gray-700 dark:bg-gray-800 dark:after:bg-gray-700 md:end-full md:top-0 md:!mx-[10px] md:mt-2 md:w-48 md:rounded-lg md:bg-white md:ps-0 md:shadow-md md:duration-[150ms] md:before:block md:after:hidden dark:md:bg-gray-800"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-header-classic-dropdown-sub">
                        <div class="space-y-0.5 p-1 md:space-y-1">
                          <a class="flex items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                            href="#">
                            About
                          </a>

                          <a class="flex items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                            href="#">
                            Downloads
                          </a>

                          <a class="flex items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                            href="#">
                            Team Account
                          </a>
                        </div>
                      </div>
                    </div>

                    <a class="flex items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                      href="#">
                      Downloads
                    </a>

                    <a class="flex items-center px-2 py-1.5 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                      href="#">
                      Team Account
                    </a>
                  </div>
                </div>
              </div>
              <!-- End Dropdown -->

              <!-- Button Group -->
              <div
                class="relative mt-1 flex flex-wrap items-center gap-x-1.5 before:absolute before:-start-px before:top-1/2 before:block before:h-4 before:w-px before:-translate-y-1/2 before:bg-gray-300 dark:before:bg-gray-700 md:ms-1.5 md:mt-0 md:ps-2.5">
                <a class="flex w-full items-center p-2 text-sm text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
                  @auth href="{{ route('login') }}" @else href="{{ route('dashboard.index') }}" @endauth>
                  <svg class="size-4 me-3 shrink-0 md:me-2" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>
                  @auth
                    {{ trans('Dasboard') }}
                  @else
                    {{ trans('Log in') }}
                  @endauth
                </a>
              </div>
              <!-- End Button Group -->
            </div>
          </div>
        </div>
        <!-- End Collapse -->
      </nav>
    </header>

    <main id="content">
      <div class="mx-auto max-w-[85rem] px-4 sm:px-6 lg:px-8">
        <div class="min-h-screen px-6 border-x-gray-200 bg-white py-10 dark:border-x-gray-700 dark:bg-gray-800 xl:border-x">
          @stack('content')
        </div>
      </div>
    </main>
  </body>

</html>

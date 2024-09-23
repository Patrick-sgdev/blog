<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset_path('post.css') }}">
    @livewireStyles
  </head>

  <body class="bg-gray-50 transition-all duration-300 dark:bg-gray-900 lg:hs-overlay-layout-open:ps-[260px]">
    @persist('sidebar')
    <header
      class="sticky inset-x-0 top-0 z-[48] flex w-full flex-wrap border-b bg-white py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 md:flex-nowrap md:justify-start lg:ps-[260px]">
      <nav class="mx-auto flex w-full basis-full items-center px-4 sm:px-6">
        <div class="me-5 lg:me-0 lg:hidden">
          <!-- Logo -->
          <a class="inline-block flex-none rounded-md text-xl font-semibold focus:opacity-80 focus:outline-none"
            href="#" aria-label="Preline">
            <svg class="h-auto w-28" width="116" height="32" viewBox="0 0 116 32" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M33.5696 30.8182V11.3182H37.4474V13.7003H37.6229C37.7952 13.3187 38.0445 12.9309 38.3707 12.5369C38.7031 12.1368 39.134 11.8045 39.6634 11.5398C40.1989 11.2689 40.8636 11.1335 41.6577 11.1335C42.6918 11.1335 43.6458 11.4044 44.5199 11.946C45.3939 12.4815 46.0926 13.291 46.6158 14.3743C47.139 15.4515 47.4006 16.8026 47.4006 18.4276C47.4006 20.0095 47.1451 21.3452 46.6342 22.4347C46.1295 23.518 45.4401 24.3397 44.5661 24.8999C43.6982 25.4538 42.7256 25.7308 41.6484 25.7308C40.8852 25.7308 40.2358 25.6046 39.7003 25.3523C39.1709 25.0999 38.737 24.7829 38.3984 24.4013C38.0599 24.0135 37.8014 23.6226 37.6229 23.2287H37.5028V30.8182H33.5696ZM37.4197 18.4091C37.4197 19.2524 37.5367 19.9879 37.7706 20.6158C38.0045 21.2436 38.343 21.733 38.7862 22.0838C39.2294 22.4285 39.768 22.6009 40.402 22.6009C41.0421 22.6009 41.5838 22.4254 42.027 22.0746C42.4702 21.7176 42.8056 21.2251 43.0334 20.5973C43.2673 19.9633 43.3842 19.2339 43.3842 18.4091C43.3842 17.5904 43.2704 16.8703 43.0426 16.2486C42.8149 15.6269 42.4794 15.1406 42.0362 14.7898C41.593 14.4389 41.0483 14.2635 40.402 14.2635C39.7618 14.2635 39.2202 14.4328 38.777 14.7713C38.34 15.1098 38.0045 15.59 37.7706 16.2116C37.5367 16.8333 37.4197 17.5658 37.4197 18.4091ZM49.2427 25.5V11.3182H53.0559V13.7926H53.2037C53.4622 12.9124 53.8961 12.2476 54.5055 11.7983C55.1149 11.3428 55.8166 11.1151 56.6106 11.1151C56.8076 11.1151 57.02 11.1274 57.2477 11.152C57.4754 11.1766 57.6755 11.2105 57.8478 11.2536V14.7436C57.6632 14.6882 57.4077 14.639 57.0815 14.5959C56.7553 14.5528 56.4567 14.5312 56.1859 14.5312C55.6073 14.5312 55.0903 14.6574 54.6348 14.9098C54.1854 15.156 53.8284 15.5007 53.5638 15.9439C53.3052 16.3871 53.176 16.898 53.176 17.4766V25.5H49.2427ZM64.9043 25.777C63.4455 25.777 62.1898 25.4815 61.1373 24.8906C60.0909 24.2936 59.2845 23.4503 58.7182 22.3608C58.1519 21.2652 57.8688 19.9695 57.8688 18.4737C57.8688 17.0149 58.1519 15.7346 58.7182 14.6328C59.2845 13.531 60.0816 12.6723 61.1096 12.0568C62.1437 11.4413 63.3563 11.1335 64.7474 11.1335C65.683 11.1335 66.5539 11.2843 67.3603 11.5859C68.1728 11.8814 68.8806 12.3277 69.4839 12.9247C70.0932 13.5218 70.5672 14.2727 70.9057 15.1776C71.2443 16.0762 71.4135 17.1288 71.4135 18.3352V19.4155H59.4384V16.978H67.7111C67.7111 16.4117 67.588 15.91 67.3418 15.473C67.0956 15.036 66.754 14.6944 66.317 14.4482C65.8861 14.1958 65.3844 14.0696 64.812 14.0696C64.2149 14.0696 63.6856 14.2081 63.2239 14.4851C62.7684 14.7559 62.4114 15.1222 62.1529 15.5838C61.8944 16.0393 61.762 16.5471 61.7559 17.1072V19.4247C61.7559 20.1264 61.8851 20.7327 62.1437 21.2436C62.4083 21.7545 62.7807 22.1484 63.2608 22.4254C63.741 22.7024 64.3103 22.8409 64.9689 22.8409C65.406 22.8409 65.8061 22.7794 66.1692 22.6562C66.5324 22.5331 66.8432 22.3485 67.1018 22.1023C67.3603 21.8561 67.5572 21.5545 67.6927 21.1974L71.3304 21.4375C71.1458 22.3116 70.7672 23.0748 70.1948 23.7273C69.6285 24.3736 68.896 24.8783 67.9974 25.2415C67.1048 25.5985 66.0738 25.777 64.9043 25.777ZM77.1335 6.59091V25.5H73.2003V6.59091H77.1335ZM79.5043 25.5V11.3182H83.4375V25.5H79.5043ZM81.4801 9.49006C80.8954 9.49006 80.3937 9.29616 79.9752 8.90838C79.5628 8.51444 79.3566 8.04356 79.3566 7.49574C79.3566 6.95407 79.5628 6.48935 79.9752 6.10156C80.3937 5.70762 80.8954 5.51065 81.4801 5.51065C82.0649 5.51065 82.5635 5.70762 82.9759 6.10156C83.3944 6.48935 83.6037 6.95407 83.6037 7.49574C83.6037 8.04356 83.3944 8.51444 82.9759 8.90838C82.5635 9.29616 82.0649 9.49006 81.4801 9.49006ZM89.7415 17.3011V25.5H85.8083V11.3182H89.5569V13.8203H89.723C90.037 12.9955 90.5632 12.343 91.3019 11.8629C92.0405 11.3767 92.9361 11.1335 93.9887 11.1335C94.9735 11.1335 95.8322 11.349 96.5647 11.7798C97.2971 12.2107 97.8665 12.8262 98.2728 13.6264C98.679 14.4205 98.8821 15.3684 98.8821 16.4702V25.5H94.9489V17.1719C94.9551 16.304 94.7335 15.6269 94.2841 15.1406C93.8348 14.6482 93.2162 14.402 92.4283 14.402C91.8989 14.402 91.4311 14.5159 91.0249 14.7436C90.6248 14.9714 90.3109 15.3037 90.0831 15.7408C89.8615 16.1716 89.7477 16.6918 89.7415 17.3011ZM107.665 25.777C106.206 25.777 104.951 25.4815 103.898 24.8906C102.852 24.2936 102.045 23.4503 101.479 22.3608C100.913 21.2652 100.63 19.9695 100.63 18.4737C100.63 17.0149 100.913 15.7346 101.479 14.6328C102.045 13.531 102.842 12.6723 103.87 12.0568C104.905 11.4413 106.117 11.1335 107.508 11.1335C108.444 11.1335 109.315 11.2843 110.121 11.5859C110.934 11.8814 111.641 12.3277 112.245 12.9247C112.854 13.5218 113.328 14.2727 113.667 15.1776C114.005 16.0762 114.174 17.1288 114.174 18.3352V19.4155H102.199V16.978H110.472C110.472 16.4117 110.349 15.91 110.103 15.473C109.856 15.036 109.515 14.6944 109.078 14.4482C108.647 14.1958 108.145 14.0696 107.573 14.0696C106.976 14.0696 106.446 14.2081 105.985 14.4851C105.529 14.7559 105.172 15.1222 104.914 15.5838C104.655 16.0393 104.523 16.5471 104.517 17.1072V19.4247C104.517 20.1264 104.646 20.7327 104.905 21.2436C105.169 21.7545 105.542 22.1484 106.022 22.4254C106.502 22.7024 107.071 22.8409 107.73 22.8409C108.167 22.8409 108.567 22.7794 108.93 22.6562C109.293 22.5331 109.604 22.3485 109.863 22.1023C110.121 21.8561 110.318 21.5545 110.454 21.1974L114.091 21.4375C113.907 22.3116 113.528 23.0748 112.956 23.7273C112.389 24.3736 111.657 24.8783 110.758 25.2415C109.866 25.5985 108.835 25.777 107.665 25.777Z"
                class="fill-blue-600 dark:fill-white" fill="currentColor" />
              <path
                d="M1 29.5V16.5C1 9.87258 6.37258 4.5 13 4.5C19.6274 4.5 25 9.87258 25 16.5C25 23.1274 19.6274 28.5 13 28.5H12"
                class="stroke-blue-600 dark:stroke-white" stroke="currentColor" stroke-width="2" />
              <path
                d="M5 29.5V16.66C5 12.1534 8.58172 8.5 13 8.5C17.4183 8.5 21 12.1534 21 16.66C21 21.1666 17.4183 24.82 13 24.82H12"
                class="stroke-blue-600 dark:stroke-white" stroke="currentColor" stroke-width="2" />
              <circle cx="13" cy="16.5214" r="5" class="fill-blue-600 dark:fill-white" fill="currentColor" />
            </svg>
          </a>
          <!-- End Logo -->
        </div>

        <div class="ms-auto flex w-full items-center justify-end gap-x-1 md:justify-between md:gap-x-3">

          <div class="hidden md:block">
            <!-- Search Input -->
            <div class="relative">
              <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-3.5">
                <svg class="size-4 shrink-0 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8" />
                  <path d="m21 21-4.3-4.3" />
                </svg>
              </div>
              <input type="text"
                class="block w-full rounded-lg border-gray-200 bg-white py-2 pe-16 ps-10 text-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:placeholder:text-gray-400 dark:focus:ring-gray-600"
                placeholder="Search">
              <div class="pointer-events-none absolute inset-y-0 end-0 z-20 flex hidden items-center pe-1">
                <button type="button"
                  class="size-6 inline-flex shrink-0 items-center justify-center rounded-full text-gray-500 hover:text-blue-600 focus:text-blue-600 focus:outline-none dark:text-gray-500 dark:hover:text-blue-500 dark:focus:text-blue-500"
                  aria-label="Close">
                  <span class="sr-only">Close</span>
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m15 9-6 6" />
                    <path d="m9 9 6 6" />
                  </svg>
                </button>
              </div>
              <div class="pointer-events-none absolute inset-y-0 end-0 z-20 flex items-center pe-3 text-gray-400">
                <svg class="size-3 shrink-0 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3" />
                </svg>
                <span class="mx-1">
                  <svg class="size-3 shrink-0 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                  </svg>
                </span>
                <span class="text-xs">/</span>
              </div>
            </div>
            <!-- End Search Input -->
          </div>

          <div class="flex flex-row items-center justify-end gap-1">
            <button type="button"
              class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700 md:hidden">
              <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
              </svg>
              <span class="sr-only">Search</span>
            </button>

            <button type="button"
              class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
              <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
              </svg>
              <span class="sr-only">Notifications</span>
            </button>

            <button type="button"
              class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
              <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
              </svg>
              <span class="sr-only">Activity</span>
            </button>

            <!-- Dropdown -->
            <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
              <button id="hs-dropdown-account" type="button"
                class="size-[38px] inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <img class="size-[38px] shrink-0 rounded-full"
                  src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                  alt="Avatar">
              </button>

              <div
                class="hs-dropdown-menu duration min-w-60 mt-2 hidden rounded-lg bg-white opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-gray-700 dark:border dark:border-gray-700 dark:bg-gray-800"
                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
                <div class="rounded-t-lg bg-gray-100 px-5 py-3 dark:bg-gray-700">
                  <p class="text-sm text-gray-500 dark:text-gray-500">Signed in as</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">james@site.com</p>
                </div>
                <div class="space-y-0.5 p-1.5">
                  <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:focus:text-gray-300"
                    href="#">
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                      <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                    </svg>
                    Newsletter
                  </a>
                  <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:focus:text-gray-300"
                    href="#">
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                      <path d="M3 6h18" />
                      <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    Purchases
                  </a>
                  <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:focus:text-gray-300"
                    href="#">
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                      <path d="M12 12v9" />
                      <path d="m8 17 4 4 4-4" />
                    </svg>
                    Downloads
                  </a>
                  <a class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:focus:text-gray-300"
                    href="#">
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                      <circle cx="9" cy="7" r="4" />
                      <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                      <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Team Account
                  </a>
                </div>
              </div>
            </div>
            <!-- End Dropdown -->
          </div>
        </div>
      </nav>
    </header>

    <div class="-mt-px">
      <!-- Breadcrumb -->
      <div
        class="sticky inset-x-0 top-0 z-20 border-y bg-white px-4 dark:border-gray-700 dark:bg-gray-800 sm:px-6 lg:hidden lg:px-8">
        <div class="flex items-center py-2">
          <!-- Navigation Toggle -->
          <button type="button"
            class="size-8 flex items-center justify-center gap-x-2 rounded-lg border border-gray-200 text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:text-gray-200 dark:hover:text-gray-500 dark:focus:text-gray-500"
            aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar"
            aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
            <span class="sr-only">Toggle Navigation</span>
            <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <rect width="18" height="18" x="3" y="3" rx="2" />
              <path d="M15 3v18" />
              <path d="m8 9 3 3-3 3" />
            </svg>
          </button>
          <!-- End Navigation Toggle -->

          <!-- Breadcrumb -->
          <ol class="ms-3 flex items-center whitespace-nowrap">
            <li class="flex items-center text-sm text-gray-800 dark:text-gray-400">
              Application Layout
              <svg class="size-2.5 mx-3 shrink-0 overflow-visible text-gray-400 dark:text-gray-500" width="16"
                height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              </svg>
            </li>
            <li class="truncate text-sm font-semibold text-gray-800 dark:text-gray-400" aria-current="page">
              Dashboard
            </li>
          </ol>
          <!-- End Breadcrumb -->
        </div>
      </div>
      <!-- End Breadcrumb -->
    </div>

    <div id="hs-application-sidebar"
      class="hs-overlay fixed inset-y-0 start-0 z-[60] hidden h-full w-[260px] -translate-x-full transform border-e border-gray-200 bg-white transition-all duration-300 [--auto-close:lg] hs-overlay-open:translate-x-0 dark:border-gray-700 dark:bg-gray-800 lg:bottom-0 lg:end-auto lg:block lg:translate-x-0"
      role="dialog" tabindex="-1" aria-label="Sidebar">
      <div class="relative flex h-full max-h-full flex-col">
        <div class="px-6 pt-4 flex justify-center">
          <!-- Logo -->
          <a class="inline-block flex-none rounded-xl text-xl font-semibold focus:opacity-80 focus:outline-none dark:text-white text-center"
            href="/" aria-label="Preline">
              BLOG
          </a>
          <!-- End Logo -->
        </div>

        <!-- Content -->
        <div
          class="h-full overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-gray-500 [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-gray-700 [&::-webkit-scrollbar]:w-2">
          <nav class="hs-accordion-group flex w-full flex-col flex-wrap p-3" data-hs-accordion-always-open>
            <ul class="flex flex-col space-y-1">
              <li>
                <a @class(['flex items-center gap-x-3.5 rounded-lg [&.active]:bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:focus:bg-gray-700 dark:hover:bg-gray-700 [&.active]:dark:bg-gray-700 dark:text-white', 'active' => Route::currentRouteName() == 'dashboard.index'])
                  href="{{ route('dashboard.index') }}">
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                  </svg>
                  {{ trans('Dashboard') }}
                </a>
              </li>
              <li>
                <a @class(['flex items-center gap-x-3.5 rounded-lg [&.active]:bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:focus:bg-gray-700 dark:hover:bg-gray-700 [&.active]:dark:bg-gray-700 dark:text-white', 'active' => in_array(Route::currentRouteName(), ['dashboard.posts', 'dashboard.post', 'dashboard.get-post'])])
                  href="{{ route('dashboard.posts') }}">
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sticky-note"><path d="M16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8Z"/><path d="M15 3v4a2 2 0 0 0 2 2h4"/></svg>
                  {{ trans('Posts') }}
                </a>
              </li>
              <li>
                <a @class(['flex items-center gap-x-3.5 rounded-lg [&.active]:bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:focus:bg-gray-700 dark:hover:bg-gray-700 [&.active]:dark:bg-gray-700 dark:text-white', 'active' => in_array(Route::currentRouteName(), ['dashboard.categories', 'dashboard.category'])])
                  href="{{ route('dashboard.categories') }}">
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column-stacked"><path d="M11 13H7"/><path d="M19 9h-4"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/><rect x="15" y="5" width="4" height="12" rx="1"/><rect x="7" y="8" width="4" height="9" rx="1"/></svg>
                  {{ trans('Categories') }}
                </a>
              </li>
              <li>
                <a @class(['flex items-center gap-x-3.5 rounded-lg [&.active]:bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:focus:bg-gray-700 dark:hover:bg-gray-700 [&.active]:dark:bg-gray-700 dark:text-white', 'active' => in_array(Route::currentRouteName(), ['dashboard.tags', 'dashboard.tag'])])
                  href="{{ route('dashboard.tags') }}">
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tags"><path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19"/><path d="M9.586 5.586A2 2 0 0 0 8.172 5H3a1 1 0 0 0-1 1v5.172a2 2 0 0 0 .586 1.414L8.29 18.29a2.426 2.426 0 0 0 3.42 0l3.58-3.58a2.426 2.426 0 0 0 0-3.42z"/><circle cx="6.5" cy="9.5" r=".5" fill="currentColor"/></svg>
                  {{ trans('Tags') }}
                </a>
              </li>
              @if(hasRole('administrator'))
              <li>
                <a @class(['flex items-center gap-x-3.5 rounded-lg [&.active]:bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:focus:bg-gray-700 dark:hover:bg-gray-700 [&.active]:dark:bg-gray-700 dark:text-white', 'active' => in_array(Route::currentRouteName(), ['dashboard.users', 'dashboard.user'])])
                  href="{{ route('dashboard.users') }}">
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  {{ trans('Users') }}
                </a>
              </li>

              <li>
                <a @class(['flex items-center gap-x-3.5 rounded-lg [&.active]:bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:focus:bg-gray-700 dark:hover:bg-gray-700 [&.active]:dark:bg-gray-700 dark:text-white', 'active' => in_array(Route::currentRouteName(), ['dashboard.roles', 'dashboard.role'])])
                  href="{{ route('dashboard.roles') }}">
                  <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                  {{ trans('Roles') }}
                </a>
              </li>
              @endif
            </ul>
          </nav>
        </div>
      </div>
    </div>
    @endpersist

    <div class="w-full lg:ps-64">
      <div class="space-y-4 p-4 sm:space-y-6 sm:p-6">

        @stack('content')
      </div>
    </div>
    @stack('modals')
    @livewireScripts
  </body>

</html>

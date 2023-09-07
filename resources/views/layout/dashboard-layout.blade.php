<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exams</title>
    {{-- Script for Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- End of Script --}}
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="bg-gray-100">
    <main class="w-full flex flex-col justify-start lg:flex-row h-full">
        <!-- Side navigation -->
        <aside x-data=" { open: false }" x-bind:class="!open? 'left-0 w-72 pt-10 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700' : 'left-0 w-20 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700 lg:w-20 lg:h-screen'">
            <div class="flex">
                <h3 class="text-sm" x-on:click="open = !open">
                    <div class="grid grid-cols-3">
                        <div class="grid col-span-1"><img src=".././images/logo.png" alt="" class="w-10 h-10" x-show="!open"></div>
                        <div class="grid col-span-1 uppercase text-xs font-bold text-green-800"  x-show="!open">Admin</div>
                        <div class="grid col-span-1 pl-12 pt-2"><svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="2.0" stroke="currentColor" class="w-5 h-5 text-[#1A988A] ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25" />
                        </svg></div>
                    </div>
                    
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#1A988A] mt-5 ml-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                      </svg>
                </h3>
            </div>

            <div class="hidden flex-col justify-between flex-1 mt-8 lg:flex" side-nav>
                <nav>
                    <!-- Dashboard -->
                    <a class="flex items-center px-4 py-4 my-4 text-white bg-[#1A988A] rounded-md dark:bg-gray-800 dark:text-gray-200" href="/admin/dashboard">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z" stroke="white"/>
                            </svg>

                        <span class="mx-4 font-medium" x-show="!open">Course</span>
                    </a>

                    <!-- Records -->
                    <a class="flex items-center px-4 py-2 my-4 mt-5 text-black transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="/admin/exam">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z" stroke="black"/>
                            </svg>

                        <span class="mx-4 font-normal" x-show="!open">Exams</span>
                    </a>

                    <!-- Courses -->
                    <a class="flex items-center px-4 py-2 my-4 mt-5 text-black transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="/admin/qna">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.1016 15.3203L17.4531 12.9062L14.8672 3.24214C14.7903 2.96215 14.6061 2.72382 14.3544 2.57898C14.1028 2.43414 13.8041 2.39451 13.5234 2.4687L11.1094 3.11714C11.0491 3.13241 10.9912 3.15608 10.9375 3.18745C10.8404 3.0255 10.703 2.89146 10.5387 2.79836C10.3744 2.70527 10.1888 2.65629 10 2.6562H7.5C7.27646 2.65493 7.05805 2.72319 6.875 2.85151C6.69195 2.72319 6.47354 2.65493 6.25 2.6562H3.75C3.45992 2.6562 3.18172 2.77143 2.9766 2.97655C2.77148 3.18167 2.65625 3.45987 2.65625 3.74995V16.2499C2.65625 16.54 2.77148 16.8182 2.9766 17.0233C3.18172 17.2285 3.45992 17.3437 3.75 17.3437H6.25C6.47354 17.345 6.69195 17.2767 6.875 17.1484C7.05805 17.2767 7.27646 17.345 7.5 17.3437H10C10.2901 17.3437 10.5683 17.2285 10.7734 17.0233C10.9785 16.8182 11.0938 16.54 11.0938 16.2499V7.2812L13.5703 16.5312C13.6337 16.7644 13.7721 16.9703 13.9641 17.1172C14.1561 17.264 14.3911 17.3436 14.6328 17.3437C14.7278 17.3422 14.8223 17.3291 14.9141 17.3046L17.3281 16.6562C17.6075 16.5811 17.8458 16.3983 17.9907 16.148C18.1357 15.8976 18.1755 15.6 18.1016 15.3203ZM12.0078 7.08589L14.7266 6.35932L16.4297 12.6953L13.7109 13.4218L12.0078 7.08589ZM11.2578 4.10151C11.2779 4.06438 11.3114 4.03641 11.3516 4.02339L13.7656 3.37495H13.8047C13.8386 3.37571 13.8716 3.38651 13.8994 3.40598C13.9272 3.42544 13.9486 3.4527 13.9609 3.48432L14.4844 5.45307L11.7656 6.17964L11.2422 4.2187C11.2327 4.17905 11.2382 4.13728 11.2578 4.10151ZM7.5 3.5937H10C10.0414 3.5937 10.0812 3.61016 10.1105 3.63946C10.1398 3.66877 10.1562 3.70851 10.1562 3.74995V13.2812H7.34375V3.74995C7.34375 3.70851 7.36021 3.66877 7.38951 3.63946C7.41882 3.61016 7.45856 3.5937 7.5 3.5937ZM3.75 3.5937H6.25C6.29144 3.5937 6.33118 3.61016 6.36049 3.63946C6.38979 3.66877 6.40625 3.70851 6.40625 3.74995V5.7812H3.59375V3.74995C3.59375 3.70851 3.61021 3.66877 3.63951 3.63946C3.66882 3.61016 3.70856 3.5937 3.75 3.5937ZM6.25 16.4062H3.75C3.70856 16.4062 3.66882 16.3897 3.63951 16.3604C3.61021 16.3311 3.59375 16.2914 3.59375 16.2499V6.7187H6.40625V16.2499C6.40625 16.2914 6.38979 16.3311 6.36049 16.3604C6.33118 16.3897 6.29144 16.4062 6.25 16.4062ZM10 16.4062H7.5C7.45856 16.4062 7.41882 16.3897 7.38951 16.3604C7.36021 16.3311 7.34375 16.2914 7.34375 16.2499V14.2187H10.1562V16.2499C10.1562 16.2914 10.1398 16.3311 10.1105 16.3604C10.0812 16.3897 10.0414 16.4062 10 16.4062ZM17.0859 15.7499L14.6719 16.3984C14.6519 16.4043 14.6309 16.4062 14.6101 16.4039C14.5894 16.4015 14.5693 16.3951 14.5511 16.3849C14.5329 16.3747 14.517 16.361 14.5042 16.3445C14.4913 16.328 14.482 16.3092 14.4766 16.289L13.9531 14.3281L16.6719 13.6015L17.1953 15.5624C17.2012 15.5819 17.203 15.6024 17.2006 15.6227C17.1982 15.6429 17.1916 15.6624 17.1814 15.68C17.1711 15.6976 17.1574 15.7128 17.1409 15.7249C17.1245 15.7369 17.1058 15.7455 17.0859 15.7499Z" fill="#52575C"/>
                            </svg>

                        <span class="mx-4 font-normal" x-show="!open">Q & A</span>
                    </a>

                    <!-- Permission Control -->
                    <a class="flex items-center px-4 py-2 my-4 mt-5 text-black transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z" stroke="black"/>
                            </svg>

                        <span class="mx-4 font-normal" x-show="!open">Results</span>
                    </a>

                    <!-- Results -->
                    <a class="flex items-center px-4 py-2 my-4 mt-5 text-black transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z" stroke="black"/>
                        </svg>

                        <span class="mx-4 font-normal" x-show="!open">Coordinator's Login</span>
                    </a>

                    <!-- Log Out-->
                    <a class="flex items-center px-4 py-2 my-4 mt-5 text-black transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="{{ route('logout') }}">
                        <span class="mx-4 font-normal" x-show="!open">Logout</span>
                    </a>
                </nav>
            </div>
        </aside>

         
         <section class="w-full p-8">
            <div class="p-12">
                @yield('space-work')
            </div>
         </section>
   
   
</body>
</html>
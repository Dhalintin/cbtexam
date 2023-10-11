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
        <aside x-data=" { open: false, activeLink: parseInt(localStorage.getItem('activeLink'))  }" x:init="activeLink = parseInt(localStorage.getItem('activeLink')) !! null" x-bind:class="!open? 'left-0 w-72 pt-10 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700' : 'left-0 w-20 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700 lg:w-20 lg:h-screen'">
            <div class="flex">
                <h3 class="text-sm" x-on:click="open = !open">
                    <div class="grid grid-cols-3">
                        <div class="grid col-span-1"><img src="../.././images/logo.png" alt="" class="w-10 h-10" x-show="!open"></div>
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
                    <a :class="{ 'dashboard-active': activeLink === 0, 'dashboard-inactive': activeLink !== 0}" @click="setActiveLink(0)" href="/admin/dashboard">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z" />
                            </svg>

                        <span class="mx-4 font-medium" x-show="!open">Course</span>
                    </a>

                    <!-- Records -->
                    <a :class="{ 'dashboard-active': activeLink === 1, 'dashboard-inactive': activeLink !== 1}" @click="setActiveLink(1)" href="/admin/exam">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z"/>
                            </svg>

                        <span class="mx-4 font-normal" x-show="!open">Exams</span>
                    </a>

                    <!-- Courses -->
                    <a :class="{ 'dashboard-active': activeLink === 2, 'dashboard-inactive': activeLink !== 2}" @click="setActiveLink(2)" href="/admin/qna">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z"/>
                        </svg>

                        <span class="mx-4 font-normal" x-show="!open">Q & A</span>
                    </a>

                    <!-- Student -->
                    <a :class="{ 'dashboard-active': activeLink === 3, 'dashboard-inactive': activeLink !== 3}" @click="setActiveLink(3)" href="{{ route('students') }}">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z"/>
                            </svg>

                        <span class="mx-4 font-normal" x-show="!open">Students</span>
                    </a>

                    <!-- Results -->
                    <a :class="{ 'dashboard-active': activeLink === 4, 'dashboard-inactive': activeLink !== 4}" @click="setActiveLink(4)" href="#">
                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.91667 8.29167H1.16667C1.00739 8.29167 0.875 8.15927 0.875 8V1.66667C0.875 1.50739 1.00739 1.375 1.16667 1.375H5.91667C6.07594 1.375 6.20833 1.50739 6.20833 1.66667V8C6.20833 8.15927 6.07594 8.29167 5.91667 8.29167ZM5.91667 14.625H1.16667C1.00739 14.625 0.875 14.4926 0.875 14.3333V11.1667C0.875 11.0074 1.00739 10.875 1.16667 10.875H5.91667C6.07594 10.875 6.20833 11.0074 6.20833 11.1667V14.3333C6.20833 14.4926 6.07594 14.625 5.91667 14.625ZM13.8333 14.625H9.08333C8.92406 14.625 8.79167 14.4926 8.79167 14.3333V8C8.79167 7.84073 8.92406 7.70833 9.08333 7.70833H13.8333C13.9926 7.70833 14.125 7.84073 14.125 8V14.3333C14.125 14.4926 13.9926 14.625 13.8333 14.625ZM8.79167 4.83333V1.66667C8.79167 1.50739 8.92406 1.375 9.08333 1.375H13.8333C13.9926 1.375 14.125 1.50739 14.125 1.66667V4.83333C14.125 4.99261 13.9926 5.125 13.8333 5.125H9.08333C8.92406 5.125 8.79167 4.99261 8.79167 4.83333Z"/>
                        </svg>

                        <span class="mx-4 font-normal" x-show="!open">Coordinator's Login</span>
                    </a>

                    <!-- Log Out-->
                    <a class="dashboard-inactive" @click="setActiveLink(0)" href="{{ route('logout') }}">
                        <span class="mx-4 font-normal" x-show="!open">Logout</span>
                    </a>
                </nav>
            </div>
        </aside>

         
         <section class="w-full p-8">
            <div class="pt-2 pr-12 pb-5">
                @yield('space-work')
            </div>

            {{-- <div class="flex justify-end">
                <a href="{{ url()->previous() }}" class="border rounded-lg p-3 border-[#1A988A] text-[#1A988A]">Back</a>
            </div>  --}}
         </section>
   
   
</body>

<script>


    function setActiveLink(index){
        this.activeLink = index;
        localStorage.setItem('activeLink', index)
    }
</script>
</html>
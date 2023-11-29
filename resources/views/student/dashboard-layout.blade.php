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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">
@php
use Illuminate\Support\Facades\URL;
@endphp
    <main class="w-full flex flex-col justify-start lg:flex-row h-full">
        <!-- Side navigation -->
    <aside x-data=" { open: false, activeLink: parseInt(localStorage.getItem('activeLink'))  }" x:init="activeLink = parseInt(localStorage.getItem('activeLink')) !! null" x-bind:class="!open? 'left-0 w-64 pt-10 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700' : 'left-0 w-20 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700 lg:w-20 lg:h-screen'">
        <div class="flex">
            <h3 class="text-sm" x-on:click="open = !open">
                <div class="grid grid-cols-3">
                    <div class="grid col-span-1"><img src="../.././images/logo.png" alt="" class="w-10 h-10" x-show="!open"></div>
                    <div class="grid col-span-1 uppercase text-xs font-bold text-green-800"  x-show="!open"></div>
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

                <div class="" x-show="!open">
                    <div class="ml-8">
                        <img src="../.././images/student.png" alt="" class="h-10 w-10 rounded-full">
                    </div>
                    <div class="ml-4"><span class="font-bold">
                        {{ auth()->user()->name }}, {{ auth()->user()->lname }}
                    </span> </div>
                    <div class="ml-4"><span class="font-bold">
                            {{ auth()->user()->reg_no }}
                        </span>
                    </div>
                    
                </div>

                <!-- Log Out-->
                <a class="dashboard-inactive shadow-sm shadow-gray-700 hover:shadow-lg hover:bg-gray-300" @click="setActiveLink(0)" href="{{ route('logout') }}">
                    <span class="mx-4 font-normal" x-show="!open">Logout</span>
                </a>
            </nav>
        </div>
    </aside>
    <section class="w-full p-8">
        <div class="pt-2 pr-12 pb-5">
            @yield('space-work')
        </div>
     </section>
    </main>
</body>

<script>


    function setActiveLink(index){
        this.activeLink = index;
        localStorage.setItem('activeLink', index)
    }
</script>
</html>
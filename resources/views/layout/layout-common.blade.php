<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exams</title>
    {{-- Script for Tailwind --}}
    @vite('resources/css/app.css')
    {{-- End of Script --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-light bg-no-repeat bg-cover dark:bg-gray-900">
    <div class="pt-8 pb-8  rounded-b-xl bg-white bg-gradient-to-r from-gray-300 to-transparent shadow-2xl shadow-gray-400">
        <div class="grid grid-cols-5">
            <div class="grid col-span-4 ">
                <div>
                    <img src="images/logo.png" alt="" class="h-20 w-20 ml-20 inline">
                    <div class="text-green-600 text-2xl font-bold inline">ALEX EKWUEME FEDERAL UNIVERSITY NDUFU ALIKE IKWO EBONYI STATE</div>
                </div>
            </div>
            <div class="ml-8 font-bold text-green-900"><a href="{{ route('register') }}"><img src="images/admin2.png" alt="" class="h-10 w-10 inline mr-3">Register</a></div>
        </div>
    </div>
    <div class="py-6">
        @yield('space-work')
    </div>
    
    
</body>
</html>
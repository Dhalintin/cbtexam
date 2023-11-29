@extends('student/dashboard-layout')

@section('space-work')
    <div class="text-center">
        <h1 class="text-red-500  text-xl font-bold pt-24">{{ $msg }}</h1>
        <a href="{{ Route('dash') }}"><button class="bg-[#1A988A] rounded-lg p-4 mt-3 text-white text-lg font-bold">Go back</button></a>
    </div>

    <div>
        <form action="{{ Route('logout') }}">
            @csrf

            <button type="submit" class="border rounded-lg bg-gray-100 shadow-md shadow-gray-600 p-3 m-64 ml-96">Logout</button>
        </form>
        
    </div>
    
@endsection

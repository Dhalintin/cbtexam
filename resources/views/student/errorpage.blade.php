@extends('student/dashboard-layout')

@section('space-work')
    <div class="text-center">
        <h1 class="text-red-500  text-xl font-bold pt-24">{{ $msg }}</h1>
        <a href="{{ URL::previous() }}"><button class="bg-[#1A988A] rounded-lg p-4 mt-3 text-white text-lg font-bold">Go back</button></a>
    </div>
    
@endsection

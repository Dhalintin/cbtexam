@extends('layout/layout-common')

@section('space-work')

    <h1>Register</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('studentRegister') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Enter Full Name">
        <br><br>
        <input type="text" name="reg_no" placeholder="Enter Registration Number">
        <br><br>
        <input type="password" name="password" placeholder="Enter password">
        <br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm password">
        <br><br>
        <input type="submit" value="Register">

    </form>

    @if (Session::has('success'))
        <p class="color:green">{{ Session::get('success') }}</p>
    @endif

@endsection

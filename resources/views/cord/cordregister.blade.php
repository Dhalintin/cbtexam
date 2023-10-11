@extends('layout/layout-common')

@section('space-work')
<div class="grid grid-cols-6 ">
 
  <div class="col-start-3 col-span-2 pr-5">
      <div class="border border-gradient-to-l pt-10 bg-white bg-gradient-to-r from-transparent to-green-100 rounded-2xl p-6 shadow-2xl dark:bg-gray-800 dark:border-gray-700">
          <div class="text-green-700 text-2xl px-1 font-bold">Cordinators Registration</div>
          <div class="pt-6">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p style="color:red;">{{ $error }}</p>
                @endforeach
            @endif
          
            @if (Session::has('error'))
                <div class="text-rose-600">{{ Session::get('error') }}</div>
            @elseif(Session::has('success'))
                <p class="color:green">{{ Session::get('success') }}</p>
            @endif
            <form action="{{ route('adminReg') }}" method="POST">
              @csrf
              
              <div>
                <label for="reg_no">First Name</label>
                <div><input type="text" name="lname" placeholder="Enter Last name" class="reg-form" required></div>

                <label for="reg_no">Last Name</label>
                <div><input type="text" name="fname" placeholder="Enter First name" class="reg-form" required></div>

                <label for="reg_no">Middle Name</label>
                <div><input type="text" name="mname" placeholder="Enter middle name" class="reg-form"></div>

                <label for="reg_no">Email</label>
                <div><input type="email" name="email" placeholder="Enter Registration Number" class="reg-form" required></div>

                <label for="reg_no">Password</label>
                <div><input type="password" name="password" placeholder="Enter password" class="reg-form" required></div>

                <label for="reg_no">Enter Password again</label>
                <div><input type="password" name="password_confirmation" placeholder="Enter password" class="reg-form" required></div>

                <input type="submit" value="Register" class="ml-32 bg-green-900 px-5 py-2 rounded-lg text-slate-100 mt-6 text-center">
              </div>
      
          </form>     
  </div> 
@endsection

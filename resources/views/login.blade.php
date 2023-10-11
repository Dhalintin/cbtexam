@extends('layout/layout-common')

@section('space-work')

<div class="grid grid-cols-6 pt-12">
  <div class="col-span-4 ml-8 mr-5 mt-8 p-5 mb-32 bg-gray-300 bg-transparent text-white rounded-xl bg-gradient-to-r from-slate-600 to-transparent">
      <div class="text-blue-300 text-border font-bold text-xl">LOG IN INSTRUCTIONS</div>
      <ul class="list-disc list-inside">
          <li class="text-lg text-white mt-2">Log in using your Reg No. as Username and your preset password.</li>
          <li class="text-lg text-white mt-2">If you have forgotten your preset password, then use the phone number as your default password.</li>
          <li class="text-lg text-white mt-2">If you are still unable to log in then meet any of the instructors in the hall</li>
      </ul>
     
     
      <div class="text-red-400 font-extrabold text-2xl pt-3"> <img src="images/warning.png" alt="" class="inline w-5 h-5"> WARNING!!</div>
      <div class="text-lg text-slate-100 mt-2">If you didn't register for this course place exit the hall immediately!!!</div>
  </div>
  <div class="col-span-2 pr-5">
      <div class="border border-gradient-to-l pt-12 bg-white bg-gradient-to-r from-transparent to-green-100 rounded-2xl p-8 shadow-2xl dark:bg-gray-800 dark:border-gray-700">
          <div class="text-green-700 text-2xl px-1 font-bold">Login</div>
          <div class="pt-12">
            @if ($errors->any())
                <p class="text-rose-600">{{ "Please fill all the fields with the correct details" }}</p>
          @endif

          @if (Session::has('error'))
            <div class="text-rose-600">{{ Session::get('error') }}</div>
          @endif
            <form action="{{ route('userLogin') }}" method="POST">
              @csrf
              
              <div>
                <label for="reg_no">Registration Number</label>
                <div><input type="text" name="reg_no" placeholder="Enter Registration Number" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white w-full h-10"></div>
                <label for="reg_no">Password</label>
                <div><input type="password" name="password" placeholder="Enter password" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white w-full h-10"></div>
                <input type="submit" @click="setActiveLink(0)" value="Login" class="ml-32 bg-green-900 px-5 py-2 rounded-lg text-slate-100 mt-8 text-center">
              </div>
      
          </form>

          <div class="text-end">You don't have an account? <a href="{{ route('register') }}" class="underline text-blue-700">Register</a></div>
             
  </div>

   

   


@endsection

<script>


  function setActiveLink(index){
      this.activeLink = index;
      localStorage.setItem('activeLink', index)
  }
</script>
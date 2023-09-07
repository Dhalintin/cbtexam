@extends('layout/dashboard-layout')

@section('space-work')
    {{-- Add Course Modal --}}
    <div class="flex justify-end">
      <div x-data="{ isOpen:false }" x-on:keyup.esc="isOpen = false" class="flex justify-center">
        <div x-show="isOpen" x-on:click="isOpen = false">
          <div class="bg-[#8acfc8] bg-opacity-50 fixed top-0 right-0 w-full h-full z-10"></div> 
         </div>
         
         <div x-show="isOpen" class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#1A988A] border border-amber-200 rounded-md text-white p-4 md:p-6 z-20">
          
            <form method="POST" action="{{ route('addCourse') }}" id="addCourse">
                @csrf
                    <div>
                        <label for="course" class="text-lg font-bold">Course</label>
                        <input type="text" name="course" placeholder="Enter Course" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white text-black w-full h-10 mt-3" required>
                    </div>
                    <div>
                        <label for="course_code" class="text-lg font-bold">Course Code</label>
                        <input type="text" name="course_code" placeholder="Enter Course" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white text-black w-full h-10 mt-3" required>
                    </div>
                <div class="flex justify-end">
                  <button x-on:click="isOpen = false" type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                <button x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</button>
                </div>   
            </form>              
         </div>
        <button x-on:click="isOpen = true" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition block">Add Course</button>
        </div>
    </div>
    {{-- End of Course Modal --}}
    
@endsection('space-work')
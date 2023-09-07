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

    <div>
        @if($success = Session::get('success'))
            <div class="text-blue-700 text-2xl">{{ $success }}</div>
        @elseif($failed = Session::get('failed'))
            <div class="text-red-700 text-2xl">{{ $failed }}</div>
        @endif
    </div>
    <div>
        <table class="w-full text-left mt-5 ">
            <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
                <th scope="col" class="pt-3 pb-3 mb-10  pr-5">#</th>
                <th scope="col">Course</th>
                <th scope="col">Course Code</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </thead>

            <tbody>
                @if(count($courses) > 0)
                    @foreach ($courses as $course)
                    <tr class="border-t-2">
                        <td class="pt-3 pb-2">{{ $course->id }}</td>
                        <td>{{ $course->course }}</td>
                        <td>{{ $course->course_code }}</td>
                        <td>
                            
                        
                        {{-- Edit Course Modal --}}
                <div class="flex">
                    <div x-data="{ isOpen:false }" x-on:keyup.esc="isOpen = false" class="flex justify-center">
                    <div x-show="isOpen" x-on:click="isOpen = false">
                        <div class="bg-[#8acfc8] bg-opacity-50 fixed top-0 right-0 w-full h-full z-10"></div> 
                    </div>
                    
                    <div x-show="isOpen" class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#1A988A] border border-amber-200 rounded-md text-white p-4 md:p-6 z-20">

                        <form method="POST" action="{{ route('editCourse',$course->id)  }}" id="editCourse">
                            @csrf
                            @method('PUT')
                                <div>
                                    <label for="course" class="text-lg font-bold">Course</label>
                                    <input type="text" name="course" placeholder="Enter Course" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white text-black w-full h-10 mt-3" data-course="{{ $course->course }}" id="course" value="{{ $course->course }}" required >
                                </div>
                                <div>
                                    <label for="course_code" class="text-lg font-bold">Course Code</label>
                                    <input type="text" name="course_code" placeholder="Enter Course" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white text-black w-full h-10 mt-3" data-code="{{ $course->course_code }}" required id="edit_course_code" value="{{ $course->course_code }}">
                                </div>
                            <div class="flex justify-left">
                                <button x-on:click="isOpen = false" type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                            <div x-on:click="isOpen = false" type="cancel" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</div>
                            </div>   
                        </form>              
                    </div>
                        <button x-on:click="isOpen = true" class="p-2 rounded-lg bg-[#0e0ee0]" id="editbutton" >Edit</button>
                    </div>
                </div>
            </td>
                
                {{-- End of Course Modal --}}
                    <td>
                        <form action="{{ route('deleteCourse',$course->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button id="{{ $course->id }}" type="submit" onclick="return confirm('Are you sure you want to delete? This process cannot be undone')" class="inline bg-[#FF0000] p-2 rounded-lg">Delete</button>
                        </form>    
                    </td>
                    <td> <a href=""> Add Exam</a></td>
                    </tr>
                    
                    @endforeach
                @else
                    <td colspan="5" class="text-center font-extrabold text-2xl text-red-600">Courses not found</td>
                @endif
            </tbody>
        </table>

        <div class="text-cyan-900 flex justify-end mt-10 text-lg">
            Number of courses: <span class="font-bold text-xl text-blue-900 ml-2">{{ count($courses) }}</span>
        </div>
    </div>

    
@endsection('space-work')

@if(count($courses) > 0)
<script>
    $().ready(function(){

        $("#addCourse").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addCourse') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if(data.success == true)
                    {
                        location.reload();

                    }else{
                        alert(data.msg)
                    }
                }
            })
        })
    })

    
</script>
@endif

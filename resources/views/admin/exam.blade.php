@extends('layout/dashboard-layout')

@section('space-work')

<table class="w-full text-left mt-5 ">
    <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
        <th scope="col" class="pt-3 pb-3 mb-10  pr-5">#</th>
        <th scope="col">Exam</th>
        <th scope="col">Course</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
    </thead>

    <tbody>

        @if(count($exams) > 0)
            @foreach ($exams as $exam)
                <tr class="border-t-2">
                    <td class="pt-3 pb-2">{{ $exam->id }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->courses[0]['course'] }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>{{ $exam->time }}</td>
                    <td>
                         {{-- Edit Course Modal --}}
                        <div class="flex">
                            <div x-data="{ isOpen:false }" x-on:keyup.esc="isOpen = false" class="flex justify-center">
                            <div x-show="isOpen" x-on:click="isOpen = false">
                                <div class="bg-[#8acfc8] bg-opacity-50 fixed top-0 right-0 w-full h-full z-10"></div> 
                            </div>
                            
                            <div x-show="isOpen" class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#1A988A] border border-amber-200 rounded-md text-white p-4 md:p-6 z-20">

                                <form method="POST" action="{{ route('editExam',$exam->id)  }}" id="editCourse">
                                    @csrf
                                    @method('PUT')
                                        <div>
                                            <label for="course" class="text-lg font-bold">Course</label>
                                            <input type="text" name="course" placeholder="Enter Course" class="modal-form" data-course="{{ $exam->course }}" id="course" value="{{ $exam->course }}" required >
                                        </div>
                                        <div>
                                            <label for="course_code" class="text-lg font-bold">Course Code</label>
                                            <input type="text" name="course_code" placeholder="Enter Course" class="modal-form" data-code="{{ $exam->course_code }}" required id="edit_course_code" value="{{ $exam->course_code }}">
                                        </div>
                                    <div class="flex justify-left">
                                        <button x-on:click="isOpen = false" type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                                    <div x-on:click="isOpen = false" type="cancel" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</div>
                                    </div>   
                                </form>              
                            </div>
                                <button x-on:click="isOpen = true" class="p-2 rounded-lg text-[#434397]" id="editbutton">Edit</button>
                                <form action="{{ route('deleteExam',$exam->id) }}" method="POST" class="inline mt-3 ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button id="{{ $exam->id }}" type="submit" onclick="return confirm('Are you sure you want to delete? This process cannot be undone')" class="inline bg-[#FF0000] p-2 rounded-lg">X</button>
                                </form>
                            </div>
                        </div>
                    </td>
                        
                {{-- End of Course Modal --}}
                    </td>
            @endforeach
        @else
            <div class="font-bold text-lg text-red-600">There are no exams</div>
        @endif
    </tbody>
</table>
        

   {{-- Add Course Modal --}}
   <div class="flex">
    <div x-data="{ isOpen:false }" x-on:keyup.esc="isOpen = false" class="flex justify-center">
      <div x-show="isOpen" x-on:click="isOpen = false">
        <div class="bg-[#8acfc8] bg-opacity-50 fixed top-0 right-0 w-full h-full z-10"></div> 
       </div>
       
       <div x-show="isOpen" class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#1A988A] border border-amber-200 rounded-md text-white p-4 md:p-6 z-20">
        
          <form method="POST" action="{{ route('addExam') }}" id="addExam">
              @csrf

                <div>
                    <label for="exam_name" class="text-lg font-bold">Exam Name</label>
                    <input type="text" name="exam_name" placeholder="Enter exam name" class="modal-form" required>
                </div>
              
                <div>
                    <label for="course_id" class="text-lg font-bold">Course</label>
                    <select type="text" name="course_id" placeholder="Select Course" class="modal-form" required >
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_code }}</option>
                        @endforeach
                    </select>
                </div>
                  <div>
                    <label for="date" class="text-lg font-bold">Date</label>
                    <input type="date" name="date" class="modal-form" min="@php echo date('Y-m-d') @endphp" required >
                </div>
                <div>
                    <label for="course" class="text-lg font-bold">Time</label>
                    <input type="time" name="time" placeholder="Select time" class="modal-form" required >
                </div>
              <div class="flex justify-end">
                <button x-on:click="isOpen = false" type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
              <button x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</button>
              </div>   
          </form>              
       </div>
      <button x-on:click="isOpen = true" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition block">Add Exam</button>
      </div>
  </div>
  {{-- End of Course Modal --}}

@endsection
<script>
    $().ready(function(){

        $("#addExam").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addExam') }}",
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
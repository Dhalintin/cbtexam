<script>
    $(document).addEventListener('DOMContentLoaded', function(){
        localStorage.setItem('activeLink', 1)
    })
</script>
@extends('layout/dashboard-layout')

@section('space-work')
    <div x-data="{ isOpen: false, formData: {} }" x-on:keyup.esc="isOpen = false" x-on:clickaway="isOpen = false">
        <!-- Button to open the modal -->
        <button @click="isOpen = true; formData = { id: '{{ route('addCourse') }}'}" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition block">
            Add Exam
        </button>

        @include('layout/notification')
        @include('layout/modals/addexam-modal')

    </div>

    <div x-data="{ isOpen: false, formData: {} }" x-on:keyup.esc="isOpen = false">
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
                            <!-- Button to open the modal -->
                        <td>
                            <button @click="isOpen = true; formData = { id: '{{ route('editCourse',$exam->id) }}', examName: '{{ $exam->exam_name }}', course_code: '{{ $exam->courses['0']['id'] }}', date: '{{ $exam->date }}', date: '{{ $exam->time }}'}">
                                Edit
                            </button> 
                        </td>
                            <td>
                                <form action="{{ route('deleteExam',$exam->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="{{ $exam->id }}" type="submit" onclick="return confirm('Are you sure you want to delete? This process cannot be undone')" class="inline bg-[#FF0000] p-2 rounded-lg">Delete</button>
                                </form>    
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="font-bold text-lg text-red-600">There are no exams</div>
                @endif
            </tbody>
        </table>
        @include('layout/modals/editexam-modal')
    </div>
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
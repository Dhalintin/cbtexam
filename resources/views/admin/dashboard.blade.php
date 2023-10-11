@extends('layout/dashboard-layout')

@section('space-work')
    <div x-data="{ isOpen: false, formData: {} }" x-on:keyup.esc="isOpen = false" x-on:clickaway="isOpen = false">
        <div class="flex justify-evenly">
            <!-- Button to open the modal -->
            <div class="mr-96">
                <button @click="isOpen = true; formData = { id: '{{ route('addCourse') }}'}" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline">
                    Add Course
                </button>
            </div>
            <div class="text-cyan-900 inline mt-2 text-lg ml-64">
                Number of courses: <span class="font-bold text-xl text-blue-900 ml-2">{{ count($courses) }}</span>
            </div>
        </div>

        @include('layout/notification')

        @include('layout./modals/addCourse-modal')
    
    </div>
        <div x-data="{ isOpen: false, formData: {} }" x-on:keyup.esc="isOpen = false">
            <table class="w-full text-left mt-5 ">
                <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
                    <th scope="col" class="pt-3 pb-3 mb-10">ID</th>
                    <th scope="col" class="pr-5">Course</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Edit</th>
                    <th></th>
                    {{-- <th scope="col">Delete</th> --}}
                </thead>

                <tbody>
                    @if (count($courses) > 0)
                        @foreach ($courses as $course)
                            <tr class="border-t-2">
                                <td>{{ $course->id }}</td>
                                <td class="pt-3 pb-2">{{ $course->course }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>
                                <!-- Button to open the modal -->
                                <button @click="isOpen = true; formData = { id: '{{ route('editCourse',$course->id) }}', course: '{{ $course->course }}', course_code: '{{ $course->course_code }}'}">
                                    Edit
                                </button>
                                </td>
                                <td>
                                    <a href="/admin/qna/{{ $course->id }}" @click = setActiveLink(2)>
                                        View Questions
                                    </a>
                                </td>
                                <td>
                                    {{-- <form action="{{ route('deleteCourse',$course->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button id="{{ $course->id }}" type="submit" onclick="return confirm('Are you sure you want to delete? This process cannot be undone')" class="inline bg-[#FF0000] p-2 rounded-lg">Delete</button>
                                    </form>     --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <!-- Modal -->
            @include('layout/modals/editCourse-modal')
        </div>

        
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function(){
        localStorage.setItem('activeLink', 0)
    })
</script>

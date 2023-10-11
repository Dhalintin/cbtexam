@extends('layout/dashboard-layout')

@section('space-work')
</div>
<div x-data="{ isOpen: false, formData: {} }" x-on:keyup.esc="isOpen = false">
    <table class="w-full text-left mt-5 ">
        <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
            <th scope="col" class="pt-3 pb-3 mb-10">Last Name</th>
            <th scope="col" class="pr-5">First Name</th>
            <th scope="col" class="pr-5">Reg Number</th>
            <th scope="col">Student</th>
            <th></th>
            {{-- <th scope="col">Delete</th> --}}
        </thead>

        <tbody>
            @if (count($students) > 0)
                @foreach ($students as $student)
                    <tr class="border-t-2">
                        <td>{{ $student->lname }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->reg_no }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-red-500 font-bold text-2xl">You have no students</td> 
                </tr>

            @endif
        </tbody>
    </table>
    <!-- Modal -->
    
</div>

        
@endsection


@extends('student/dashboard-layout')

@section('space-work')
    <div class="font-bold text-[#1A988A] text-2xl text-center">Registered Exam</div>
    @include('layout/notification')
    <table class="w-full text-left mt-5 ">
        <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
            <th class="pt-3 pb-3 mb-10  pr-5">#</th>
            <th>Exam Name</th>
            <th>Subject Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </thead>
        <tbody>
            @if(count($regExam) > 0)
            @php $count = 1; @endphp
                @foreach ($regExam as $exam)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $exam['exams'][0]['exam_name'] }}</td>
                        <td>{{ $exam['exams'][0]['courses'][0]['course'] }}</td>
                        <td>{{ $exam['exams'][0]['date'] }}</td>
                        <td>{{ $exam['exams'][0]['time'] }}</td>
                        <td class="pt-1">
                            @if($exam['exams'][0]['attempt_counter'] >= 1)
                                {{ "Submitted" }}
                            @else
                                <a href="{{ route('exam', $exam['exams'][0]['uniqueID']) }}" class="bg-green-600 p-2 rounded-lg">Take Exam</a>
                                <a href="{{ route('deleteExReg', $exam['exams'][0]['id']) }}"></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>You haven't registered for any exam</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div x-data="{ isOpen: false}" x-on:keyup.esc="isOpen = false" x-on:clickaway="isOpen = false">
        <div class="flex justify-end">
            <!-- Button to open the modal -->
            <div class="">
                <button  @click="isOpen = true;" class="float-right mt-10 btn">Register Exams</button>
                @include('layout\modals\registerexam-modal')
            </div>
        </div>
    </div>

{{-- --}}
@endsection

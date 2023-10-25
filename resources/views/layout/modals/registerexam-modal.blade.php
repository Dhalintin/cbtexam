<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-[#1A988A] w-full md:max-w-4xl mx-auto shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div class="text-xl font-bold mb-4 text-center">Register for an exam</div>
            
            <table class="w-full text-left mt-5 text-lg">
                <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
                    <th class="pt-3 pb-3 mb-10  pr-5">#</th>
                    <th>Exam Name</th>
                    <th>Subject Name</th>
                    <th>Date</th>
                    <th>Time</th>
                </thead>
                <tbody>
                    @if(count($exams) > 0)
                    @php $count = 1; @endphp
                        @foreach ($exams as $exam)
                            <tr>
                                <td class="hidden">{{ $exam->id }}</td>
                                <td>{{ $count++ }}</td>
                                <td>{{ $exam->exam_name }}</td>
                                <td>{{ $exam->courses[0]['course'] }}</td>
                                <td>{{ $exam->date }}</td>
                                <td>{{ $exam->time }}</td>
                                <td>
                                    <form action="{{ route('registerExam', $exam->id) }}" method="POST">
                                        @csrf
                                        <button>Register</button>
                                    </form>
                                </td>
                                {{-- <td><a href="{{ route('exam', $exam->uniqueID) }}">Register for exam</a></td> --}}
                                
                            </tr>
                            
                        @endforeach
                    @else
                        <tr>
                            <td>You don't have any exams</td>
                        </tr>
                    @endif
                </tbody>
            </table> 
        </div>
    </div>
</div>
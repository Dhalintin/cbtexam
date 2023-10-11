@extends('layout/dashboard-layout')

@section('space-work')
    @include('layout/notification')
    <div x-data="{ isOpen: false, formData: {}, uploadModal:false }" setActiveLink(2) x-on:keyup.esc="isOpen = false, uploadModal = false" x-on:clickaway="isOpen = false, uploadModal = false">
        <!-- Button to open the modal -->
        <button @click="isOpen = true; formData = { id: '{{ route('addQuestion') }}'}" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline">
            Add Questions
        </button>

        @include('layout/modals/addquestion-modal')

        <button @click="uploadModal = true; formData = { id: '{{ route('uploadQuestion') }}'}" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline">
            Upload Question
        </button>

        @include('layout/modals/uploadquestion')
    
    </div>
    </div>
        <div x-data="{ isOpen: false, formData: {}, answermodal:false }" x-on:keyup.esc="isOpen = false" class="min-h-screen">
            <table class="w-full text-left mt-1 ">
                <thead class="border-t-4 border-b-4 text-lg font-bold text-[#103a36]">
                    <th scope="col" class="pt-3 pb-3 mb-10  pr-5">Question</th>
                    <th scope="col">Course</th>
                </thead>

                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr class="border-t-2">
                                <td class="pt-4 pb-3">{{ $question->question }}</td>
                                <td>{{ $question->courses['course'] }}</td>
                                @php
                                    $answers = $question->answers;
                                @endphp
                                
                                <td>

                                    <!-- Button to open the answer modal -->
                                    <button class="ansButton text-blue-500 text-lg font-semibold underline" 
                                        @click="answermodal = true; 
                                        formData = { 
                                            id: '{{ route('editExam',$question->id) }}',
                                            answer1: '{{ $question->answers[0]['answer'] }}',
                                            is_correct1:  '{{ $question->answers[0]['is_correct'] }}', 
                                            answer2: '{{ $question->answers[1]['answer'] }}', 
                                            is_correct2:  '{{ $question->answers[1]['is_correct'] }}',
                                            answer3: '{{ $question->answers[2]['answer'] }}',
                                            is_correct3:  '{{ $question->answers[2]['is_correct'] }}',
                                            answer4: '{{ $question->answers[3]['answer'] }}',
                                            is_correct4:  '{{ $question->answers[3]['is_correct'] }}',
                                        }" >
                                        View Answers
                                    </button>
                                </td>
                                <td>
                                    <!-- Button to open the modal -->
                                    <button class="text-blue-500 text-lg font-semibold" 
                                        @click="isOpen = true; 
                                        formData = { 
                                            id: '{{ route('editExam',$question->id) }}', 
                                            course: '{{ $question->courses['id'] }}', 
                                            question: '{{ $question->question }}', 
                                            type: '{{ $question->type }}', 
                                            answer1: '{{ $question->answers[0]['answer'] }}',
                                            is_correct1:  '{{ $question->answers[0]['is_correct'] }}', 
                                            answer2: '{{ $question->answers[1]['answer'] }}', 
                                            is_correct2:  '{{ $question->answers[1]['is_correct'] }}',
                                            answer3: '{{ $question->answers[2]['answer'] }}',
                                            is_correct3:  '{{ $question->answers[2]['is_correct'] }}',
                                            answer4: '{{ $question->answers[3]['answer'] }}',
                                            is_correct4:  '{{ $question->answers[3]['is_correct'] }}',
                                        }">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('deleteQuestion',$question->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button id="{{ $question->id }}" type="submit" onclick="return confirm('Are you sure you want to delete? This process cannot be undone')" class="inline bg-[#FF0000] p-2 rounded-lg">Delete</button>
                                    </form>    
                                </td>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <td class="font-bold text-lg text-red-600 cols-span-3 text-center">There are no questions for this course</td> 
                            </tr>
                    @endif
                </tbody>
            </table>
            <!-- Modal -->
            @include('layout/modals/editquestion-modal')

            @include('layout/modals/answermodal')
            {{-- <div class="p-4 space-evenly">{{ $questions->links() }}</div> --}}
        </div>

        
@endsection
<script>
    $(document).ready(function(){
        //Show answers

        $(".ansButton").click(function(){

            var questions = @json($questions);
            var qid = $(this).attr('data-id');
            var html = '';
            console.log($questions);

            // for(let i=0; i<questions.length; i++){

            //     if(){

            //     }
            // }
        })
    })
</script>

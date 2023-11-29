@extends('student/dashboard-layout')

@section('space-work')

@php
    $time = explode(':','00:30')
@endphp

    <div x-data="{ currentQuestion: 0 }">
        <p>Welcome, {{ Auth::user()->name }}</p>
        <p>{{ $exam[0]['exam_name'] }}</p>
        @if($type === 'objective')
            <div class="pt-3, pl-3">
                @if($success == true)
                @php $count = 1; @endphp
                <div class="text-right text-blue-800 font-semibold text-xl time">00:01</div>
                <form action="{{ route('examSubmit', 'objective') }}" method="POST" onsubmit="isValid()" id="exam-form">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">
                    <input type="hidden" name="score" value="{{ $exam[0]['score'] }}">
                    @if (count($qna) > 0)
                    @php 
                        $option = 'a'; 
                        $curQ = 0;
                    @endphp
                        @foreach ($qna as $data)
                            <div x-show="currentQuestion === {{ $curQ }}" class="px-24 py-20 mt-8 border-2 rounded-lg shadow-lg shadow-gray-200">
                                <div class="pt-2 font-bold">{{ $count++ }}.)<p class="capitalize inline ml-3"> {{ $data['question'] }}</p></div>
                                <input type="hidden" name="q[]" value="{{ $data['id'] }}">
                                <input type="hidden" name="ans_{{ $count-1 }}" id="ans_{{ $count-1 }}">
                                @foreach ($data['answers'] as $answer)
                                    <div class="pt-2 pl-3">
                                        {{ $option++ }}.)
                                        <input type="radio" name="radio_{{ $count-1 }}" value="{{ $answer['id'] }}" data-id="{{ $count-1 }}" class="select-ans">
                                        {{ $answer['answer'] }}
                                    </div>
                                @endforeach
                                @php  
                                    $option = 'a';
                                @endphp
                            </div>

                            @php 
                                $curQ++;
                            @endphp
                        @endforeach
                        <div class="mt-8 mb-8">
                            <div
                                x-show="currentQuestion > 0 && currentQuestion < {{ count($qna) }}"
                                @click="currentQuestion--"
                                class="w-32 focus:outline-none inline float-left py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
                            >Previous</div>
                            <div x-show="currentQuestion < {{ count($qna) }}" class="w-32 focus:outline-none float-right py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" x-on:click="currentQuestion++">Next</div>
                        </div>

                        <div class="text-center mt-20" x-show="currentQuestion == {{ count($qna) }}">
                            <div>You cannot undo this action. Ensure that you have answered all the questions before you submit this exam.</div>
                            <div class="m-8">If you haven't finished <span @click="currentQuestion = 0" class="focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Go back</span></div>
                            <button type="submit" class="btn">Submit</button>
                        </div>
                        
                </form>
                @else
                    <h1>Questions ANS ANSWERS NOT AVAILABLE</h1>
                @endif

            @else
                <h1 class="text-red-500">{{ $msg }}</h1>
            @endif
        </div>
        @else
        <div class="pt-3, pl-3">
            @if($success == true)
            @php $count = 1; @endphp
            <div class="text-right text-blue-800 font-semibold text-xl time">00:01</div>
            <form action="{{ route('examSubmit', 'subjective') }}" method="POST" onsubmit="isValid()" id="exam-form">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">
                <input type="hidden" name="score" value="{{ $exam[0]['score'] }}">
                @if (count($qna) > 0)
                @php 
                    $curQ = 0;
                @endphp
                    @foreach ($qna as $data)
                        <div x-show="currentQuestion === {{ $curQ }}" class="px-24 py-20 mt-8 border-2 rounded-lg shadow-lg shadow-gray-200">
                            <div class="pt-2 font-bold">{{ $count++ }}.)<p class="capitalize inline ml-3"> {{ $data['question'] }}</p></div>
                            <input type="hidden" name="q[]" value="{{ $data['id'] }}">
                            {{-- <input type="hidden" name="ans_{{ $count-1 }}" id="ans_{{ $count-1 }}"> --}}
                            <div class="pt-2 pl-3">
                                Answer
                                <input type="text" name="answer_{{ $count-1 }}" data-id="{{ $count-1 }}" class="select-ans rounded-sm bg-white text-black shadow-sm shadow-gray-400 m-5 px-6 font-bold text-lg">
                            </div>
                            @php  
                                $option = 'a';
                            @endphp
                        </div>
                        @php 
                            $curQ++;
                        @endphp
                    @endforeach
                    <div class="mt-8 mb-8">
                        <div
                            x-show="currentQuestion > 0 && currentQuestion < {{ count($qna) }}"
                            @click="currentQuestion--"
                            class="w-32 focus:outline-none inline float-left py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
                        >Previous</div>
                        <div x-show="currentQuestion < {{ count($qna) }}" class="w-32 focus:outline-none float-right py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" x-on:click="currentQuestion++">Next</div>
                    </div>

                    <div class="text-center mt-20" x-show="currentQuestion == {{ count($qna) }}">
                        <div>You cannot undo this action. Ensure that you have answered all the questions before you submit this exam.</div>
                        <div class="m-8">If you haven't finished <span @click="currentQuestion = 0" class="focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Go back</span></div>
                        <button type="submit" class="btn">Submit</button>
                    </div>
                    
            </form>
            @else
                <h1>Questions ANS ANSWERS NOT AVAILABLE</h1>
            @endif

        @else
            <h1 class="text-red-500">{{ $msg }}</h1>
        @endif
        @endif
    </div>

<script>
    window.addEventListener('DOMContentLoaded', function(){    
        const radios = document.querySelectorAll('input[type="radio"].select-ans');
        const answerInputs = document.querySelectorAll('input[name^="ans_"]');

        for (const radio of radios) {
            radio.addEventListener('click', function() {
                const index = this.dataset.id;
                const answerInput = answerInputs[index - 1];
                answerInput.value = this.value;
            });
        }

        const time = @json($time);
        console.log(time[0])
        $('.time').text(time[0]+':'+time[1]+':00 Left time');

        let seconds = 59;
        let hours = parseInt(time[0]);
        let minutes = parseInt(time[1]);

        const timer = setInterval(() => {
            if(hours == 0 && minutes == 0 && seconds == 0){
                clearInterval(timer);
                const examForm = document.querySelector('#exam-form');
                examForm.submit();
            }
            
            if(seconds <= 0){
                minutes--;
                seconds = 4;
            }

            if(minutes <= 0 && hours != 0){
                hours--;
                minutes = 59;
                seconds = 59;
            }

            let tempHours = hours.toString().length > 1? hours:'0'+hours;
            let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
            let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;

            if(hours == 0){

            }

            $('.time').text(tempHours+':'+tempMinutes+':'+tempSeconds+' Left time');
            seconds--;
        }, 1000)

      function isValid(){
        let result = false;

        var length = parseInt("{{ $count }}")-1;
        document.querySelector('.error_msg').remove();
        for (let i = 1; i <= length; i++) {
            if (document.querySelector('#ans_' + i).value === "") {
                result = false;

                document.querySelector('#ans_' + i).parentNode().appendChild(document.createElement('span').classList.add('text-red-300 error-msg').textContent = 'Please select answers.');

                setTimeout(() => {
                    document.querySelector('.error_msg').remove();
                }, 5000);
            }
        }
      }
    })
</script>
@endsection

{{-- <div class="qna">
    <div x-show="currentQuestion === 0">
      <div class="pt-2">Q.1 {{ $qna[0]['question'] }}</div>
      <input type="hidden" name="q[]" value="{{ $qna[0]['id'] }}">
      <input type="hidden" name="ans_0" id="ans_0">
      @foreach ($qna[0]['answers'] as $answer)
        <div class="pt-2 pl-3">
          {{ $option++ }}.)
          <input type="radio" name="radio_0" value="{{ $answer['id'] }}" data-id="0" class="select-ans">
          {{ $answer['answer'] }}
        </div>
      @endforeach
    </div>

    <div x-show="currentQuestion === 1">
      <div class="pt-2">Q.2 {{ $qna[1]['question'] }}</div>
      <input type="hidden" name="q[]" value="{{ $qna[1]['id'] }}">
      <input type="hidden" name="ans_1" id="ans_1">
      @foreach ($qna[1]['answers'] as $answer)
        <div class="pt-2 pl-3">
          {{ $option++ }}.)
          <input type="radio" name="radio_1" value="{{ $answer['id'] }}" data-id="1" class="select-ans">
          {{ $answer['answer'] }}
        </div>
      @endforeach
    </div>

    <button type="button" x-on:click="currentQuestion++">Next</button>
  </div> --}}

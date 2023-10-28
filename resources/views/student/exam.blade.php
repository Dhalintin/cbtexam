@extends('student/dashboard-layout')

@section('space-work')

@php
    $time = explode(':','00:30')
@endphp

    <div>
        <p>Welcome, {{ Auth::user()->name }}</p>
        <p>{{ $exam[0]['exam_name'] }}</p>
        <div class="pt-3, pl-3">
            @if($success == true)
            @php $count = 1; @endphp
            <div class="text-right text-blue-800 font-semibold text-xl time">00:01</div>
            <form action="{{ route('examSubmit') }}" method="POST" onsubmit="isValid()" id="exam-form">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">
                <input type="text" name="score" value="{{ $exam[0]['score'] }}">
                @if (count($qna) > 0)
                @php $option = 'a'; @endphp
                    @foreach ($qna as $data)
                        <div>
                            <div class="pt-2">Q.{{ $count++ }} {{ $data['question'] }}</div>
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
                    @endforeach
                    <div class="text-center">
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

<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-[#1A988A] opacity-50" x-on:click="isOpen = false"></div>

    <div class="modal-container bg-[#1A988A] w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div class="text-2xl font-bold mb-2 text-center">Add Question</div>
            
            <!-- Form -->
            <form method="POST" action="{{ route('addQuestion') }}" id="addQna">
                @csrf
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
                    <label for="question" class="text-lg font-bold">Add Question</label>
                    <textarea name="question" placeholder="Enter question"  class="modal-form-textarea question" required></textarea>
                </div>
                <div class="mt-2">
                    <button class="bg-white border border-white text-[#1A988A] rounded-lg p-1 m-1" id="addButton">Add Options</button>
                    <div id="option"></div>
                </div>
                
                <div>
                    <label for="question" class="text-lg font-bold block">Question Type</label>
                    <input type="radio" name="type" value="objective"> Objective
                    <input type="radio" name="type" value="subobjective" class="ml-8"> Sub-Objective
                </div>

                <div class="error text-red-700 text-lg font-semibold"></div>
                <div class="flex justify-end">
                  <button  type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                <button x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</button>
                </div>   
            </form>              
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#addQna").submit(function(e){
            e.preventDefault();

            if($(".options").length < 2){
                $(".error").text("Please add minimum two answers.")
                setTimeout(function(){
                    $(".error").text("")
                },2000)
            }
            else{

                var checkIsCorrect = false;

                for(let i = 0; i < $(".is_correct").length; i++){
                    if( $(".is_correct:eq("+i+")").prop('checked') == true)
                    {
                        checkIsCorrect = true;
                        $(".is_correct:eq("+i+")").val(".is_correct:eq("+i+")").next().find('input').val();
                    }
                }

                if(checkIsCorrect){

                    var formData = $(this).serialize();

                    $.ajax({
                        url:"{{ route('addQuestion') }}",
                        type:"POST",
                        data:formData,
                        success:function(data){
                        if(data.success == true){
                                location.reload();
                            }else{
                                alert(data.message);
                            }
                        }
                    });
                }
                else{
                    $(".error").text("Please select anyone correct answer.")
                    setTimeout(function(){
                        $(".error").text("")
                    },2000)
                }

            }
            
        });


    $("#addButton").click(function(e){
        e.preventDefault();
       if($(".options").length >= 4){
           (".error").text("You cannot add more than 4 options");
           setTimeout(function(){
               $(".error").text("");
           }, 2000);

       }else{
           var html = `<div class="row answers">
                           <input type="radio" name="is_correct" class="is_correct">
                           <div class="col inline">
                               <input type="text" name="answers[]" class="option-field options inline " required>
                           </div>
                           <button class="removeButton inline text-white font-bold bg-red-500 p-1 py-1 rounded-lg">Delete</button>
                       </div>
                       `;
               $("#option").append(html);
       }
       
   });


   //Remove answer
   $(document).on("click", ".removeButton", function(){
           $(this).parent().remove();
       });
})
</script>

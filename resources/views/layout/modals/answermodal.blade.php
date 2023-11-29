<div x-show="answermodal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-[#1A988A] opacity-50" x-on:click="answermodal = false"></div>

    <div class="modal-container bg-[#1A988A] w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="answermodal = false">X</button>
            </div>
            <div class="text-2xl font-bold mb-4 text-center">Answers to this quetion</div>

            <table class="table w-full text-left mt-1 ">
                <thead class="text-lg font-bold text-[#103a36] w-full">
                    <th scope="col" class="pt-3 pb-3 mb-10  pr-5">Options</th>
                    <th scope="col"></th>
                </thead>
                <tbody id="answer" class="showAnswer">
                    <td>
                        <div x-show="formData.answer1"  x-text="formData.answer1" class="text-white font-semibold text-lg pt-2"></div>
                        <div x-show="formData.answer2"  x-text="formData.answer2" class="text-white font-semibold text-lg pt-2"></div>
                        <div x-show="formData.answer3"  x-text="formData.answer3" class="text-white font-semibold text-lg pt-2"></div>
                        <div x-show="formData.answer4"  x-text="formData.answer4" class="text-white font-semibold text-lg pt-2"></div>
                    </td>
                    <td>
                        <div x-show="formData.answer1" x-text="formData.is_correct1 === '1' ? 'Correct' : 'Incorrect'" class="text-white font-semibold text-lg pt-2"></div>
                        <div x-show="formData.answer2" x-text="formData.is_correct2 === '1' ? 'Correct' : 'Incorrect'" class="text-white font-semibold text-lg pt-2"></div>
                        <div x-show="formData.answer3" x-text="formData.is_correct3 === '1' ? 'Correct' : 'Incorrect'" class="text-white font-semibold text-lg pt-2"></div>
                        <div x-show="formData.answer4" x-text="formData.is_correct4 === '1' ? 'Correct' : 'Incorrect'" class="text-white font-semibold text-lg pt-2"></div>
                    </td>
                </tbody>
            </table>       
        </div>
    </div>
</div>

{{-- <script>
    const body = document.getElementById("answer");
    var html = `<div class="text-red-300">Welcome</div>`

               $("#answer").append(html);
</script> --}}


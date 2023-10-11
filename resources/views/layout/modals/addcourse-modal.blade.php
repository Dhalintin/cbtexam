<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-[#1A988A] w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div class="text-xl font-bold mb-4">Add Course</div>
            
            <!-- Form -->
            <form method="POST" x-bind:action="formData.id" id="myForm">
                @csrf
                
                <div class="">
                    <label for="course" class="block text-gray-700 font-bold  text-lg">Course:</label>
                    <input type="text" id="course" name="course" x-model="formData.course" class="modal-form" />
                </div>

                <div class="">
                    <label for="course_code" class="block font-bold text-white text-lg">Course Code:</label>
                    <input type="text" id="course_code" name="course_code" x-model="formData.course_code" class="modal-form" />
                </div>

                <div class="flex justify-end">
                    <button  type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                    <span x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">
                        Close
                    </span>
                  </div>  
            </form>
        </div>
    </div>
</div>
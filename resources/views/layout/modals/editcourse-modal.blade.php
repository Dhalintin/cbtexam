<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div class="text-xl font-bold mb-4">Edit Course</div>
            
            <!-- Form -->
            <form method="POST" x-bind:action="formData.id" id="myForm">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="course" class="block text-gray-700 font-bold mb-2">Course:</label>
                    <input type="text" id="course" name="course" x-model="formData.course" class="modal-form" />
                </div>

                <div class="mb-4">
                    <label for="course_code" class="block text-gray-700 font-bold mb-2">Course Code:</label>
                    <input type="text" id="course_code" name="course_code" x-model="formData.course_code" class="modal-form" />
                </div>

                <button type="submit">Submit</button>
            </form>

            <!-- Modal actions (close button) -->
            <div class="modal-footer justify-end pt-2">
                <button @click="isOpen = false" class="modal-close px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
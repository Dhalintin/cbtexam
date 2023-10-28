<div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-[#1A988A] opacity-50" x-on:click="isOpen = false"></div>

    <div class="modal-container bg-[#1A988A] w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto text-white rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="isOpen = false">X</button>
            </div>
            <div class="text-2xl font-bold mb-4 text-center">Add Exam</div>
            
            <!-- Form -->
            <form method="POST" action="{{ route('addExam') }}" id="addExam">
                @csrf
  
                  <div>
                      <label for="exam_name" class="text-lg font-bold">Exam Name</label>
                      <input type="text" name="exam_name" placeholder="Enter exam name" class="modal-form" required>
                  </div>
                
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
                        <label for="score" class="text-lg font-bold">Course</label>
                        <select type="text" name="score" placeholder="Select Score" class="modal-form" required >
                            <option value="">Select Score</option>
                            <option value="70">70</option>
                            <option value="30">30</option>
                        </select>
                  </div>
                    <div>
                      <label for="date" class="text-lg font-bold">Date</label>
                      <input type="date" name="date" class="modal-form" min="@php echo date('Y-m-d') @endphp" required >
                  </div>
                  <div>
                      <label for="course" class="text-lg font-bold">Time</label>
                      <input type="time" name="time" placeholder="Select time" class="modal-form" required >
                  </div>
                <div class="flex justify-end">
                  <button x-on:click="isOpen = false" type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                <button x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</button>
                </div>   
            </form>              
        </div>
    </div>
</div>
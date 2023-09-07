{{-- {{-- @extends('layout/dashboard-layout')

@section('space-work')
    {{-- Add Course Modal --}}
    {{-- <div class="flex justify-end">
        <div x-data="{ isOpen:false }" x-on:keyup.esc="isOpen = false" class="flex justify-center">
          <div x-show="isOpen" x-on:click="isOpen = false">
            <div class="bg-[#8acfc8] bg-opacity-50 fixed top-0 right-0 w-full h-full z-10"></div> 
           </div>
           
           <div x-show="isOpen" class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#1A988A] border border-amber-200 rounded-md text-white p-4 md:p-6 z-20">
            
              <form method="POST" action="{{ route('addCourse') }}" id="addCourse">
                  @csrf
                      <div>
                          <label for="course" class="text-lg font-bold">Course</label>
                          <input type="text" name="course" placeholder="Enter Course" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white text-black w-full h-10 mt-3" required>
                      </div>
                      <div>
                          <label for="course_code" class="text-lg font-bold">Course Code</label>
                          <input type="text" name="course_code" placeholder="Enter Course" class="rounded-lg border-2 border-green-300 p-2 pl-4 bg-white text-black w-full h-10 mt-3" required>
                      </div>
                  <div class="flex justify-end">
                    <button x-on:click="isOpen = false" type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                  <button x-on:click="isOpen = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6" >Cancel</button>
                  </div>   
              </form>              
           </div>
          <button x-on:click="isOpen = true" class="text-white border bg-[#1A988A] border-green-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition block">Add Course</button>
          </div>
      </div> --}}
      {{-- End of Course Modal --}}
{{-- @endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal with Pre-populated Form</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div x-data="{ isOpen: false, formData: {} }">
        <!-- Button to open the modal -->
        <button @click="isOpen = true; formData = { name: 'John Doe', email: 'john@example.com', age: 25 }">
            Open Modal
        </button>
        <button @click="isOpen = true; formData = { name: 'Jane Doe', email: 'jane@example.com', age: 20 }">
            Open Modal
        </button>
        <div>Welcome</div>

        <!-- Modal -->
        <div x-show="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <!-- Modal content -->
                <div class="modal-content py-4 text-left px-6">
                    <div class="text-xl font-bold mb-4">User Information</div>
                    
                    <!-- Form -->
                    <form>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                            <input type="text" id="name" x-model="formData.name" class="border rounded w-full py-2 px-3" />
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                            <input type="email" id="email" x-model="formData.email" class="border rounded w-full py-2 px-3" />
                        </div>

                        <div class="mb-4">
                            <label for="age" class="block text-gray-700 font-bold mb-2">Age:</label>
                            <input type="number" id="age" x-model="formData.age" class="border rounded w-full py-2 px-3" />
                        </div>
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
    </div>
</body>
</html>


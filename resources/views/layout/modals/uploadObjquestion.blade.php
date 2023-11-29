<div x-show="uploadModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-[#1A988A] opacity-50" x-on:click="uploadModal = false"></div>

    <div class="modal-container bg-[#1A988A] w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-[#1A988A] rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="uploadModal = false">X</button>
            </div>
            <div class="text-2xl font-bold mb-4 text-center text-white">Upload Questions</div>
                <form id="importQna"  action="{{ Route('uploadQuestion', 0) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="bg-white rounded-lg pt-5 px-10 pb-8 pr-8 mr-3"> 
                        <p class="my-2">Upload sheet of courses</p>
                        <div class="">
                            <div class="flex items-center justify-center w-full">
                                <label for="file" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg aria-hidden="true" class="w-4 h-4 mb-1 mt-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400 text-center">Drag and Drop the excel file or click to upload</p>
                                    </div>
                                    
                                </label>                                        
                                <input id="file" type="file" name="file" accept=".cvs, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ,application/vnd.ms.excel" required />
                            </div> 
                        </div>
                    </div>
                    
                    <div class="mb-3 mt-3">
                        <img src="images/info.png" alt="" class="inline text-[#1A988A] "> 
                        <button type="submit" x-on:click="isOpen = false" class="border border-white text-white rounded-lg p-3 bg-[#1A988A] px-5 flex mb-5 mt-3 left-full right-0 float-right">Upload</button>
                    </div>
                </form>
            </div>             
        </div>
    </div>
</div>




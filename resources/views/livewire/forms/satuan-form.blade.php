 <!-- Modal content -->
 <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
     <!-- Modal header -->
     <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
         <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form Satuan</h3>
         <button type="button" wire:click="$dispatch('closeModal')"
             class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
             <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                 <path fill-rule="evenodd"
                     d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                     clip-rule="evenodd" />
             </svg>
             <span class="sr-only">Close modal</span>
         </button>
     </div>
     <!-- Modal body -->
     <form wire:submit="save">
         <div class="grid gap-4 mb-4 mt-sm:grid-cols-2">
             <div class="sm:col-span-2">
                 <label for="satuan"
                     class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                 <input type="text" name="satuan" id="satuan" wire:model="form.satuan"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     placeholder="Masukan Satuan">
                 @error('form.satuan')
                     <span class="error text-red-500 text-sm">{{ $message }}</span>
                 @enderror   
             </div>
         </div>
         <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
             <button type="submit"
                 class="w-full sm:w-auto justify-center text-white inline-flex bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit
            </button>
             <button type="button" wire:click="$dispatch('closeModal')"
                 class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                 <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd"
                         d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                         clip-rule="evenodd" />
                 </svg>
                 Discard
             </button>
         </div>
     </form>
 </div>
 

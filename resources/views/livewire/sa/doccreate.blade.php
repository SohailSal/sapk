<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form>
      <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
              <div class="mb-4">
                  <label for="exampleFormControlInput1" class="block text-white text-sm font-bold mb-2">Reference:</label>
                  <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Ref" wire:model="ref">
                  @error('ref') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
        </div>
      </div>
      <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
              <div class="mb-4">
                  <label for="exampleFormControlInput1" class="block text-white text-sm font-bold mb-2">Date:</label>
                  <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Date" wire:model="date">
                  @error('date') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
        </div>
      </div>
      <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
              <div class="mb-4">
                  <label for="exampleFormControlInput1" class="block text-white text-sm font-bold mb-2">Description:</label>
                  <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Description" wire:model="description">
                  @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
        </div>
      </div>
      <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
              <div class="mb-4">
                  <label for="exampleFormControlInput1" class="block text-white text-sm font-bold mb-2">Type:</label>
                  <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Type" wire:model="type_id">
                  @error('type_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
        </div>
      </div>


      <div class="bg-gray-400 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Save
          </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-black shadow-sm hover:bg-gray-200 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancel
          </button>
        </span>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Name:</label>
                    <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="name">
                    @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Address:</label>
                    <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="address">
                    @error('address') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Email:</label>
                    <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="email">
                    @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Web address:</label>
                    <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="web">
                    @error('web') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Phone:</label>
                    <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="phone">
                    @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Year-end month:</label>
                    <select wire:model="fiscal" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Select month:</option>
                        <option value='June'>June</option>
                        <option value='December'>December</option>
                        <option value='September'>September</option>
                        <option value='March'>March</option>
                      </select>
                    @error('fiscal') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-800 px-4 pt-1 pb-1">
          <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-1">Date of Incorporation:</label>
                    <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 mb-4 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="incorp">
                    @error('incorp') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
          </div>
        </div>
        <div class="bg-gray-400 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
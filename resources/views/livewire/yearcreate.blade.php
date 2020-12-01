<div class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex">
    <div class="flex mx-auto items-start mt-10 mb-10 overflow-auto" wire:keydown.escape="closeModal()">
      <form>
      <div class="flex flex-col md:flex-row bg-gray-800">
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="begin">

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="end">

                  </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-400 px-4 py-2 sm:px-6 sm:flex sm:flex-row rounded-b-lg">
          <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-600 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </div>
          <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </div>
         <span class="inline-flex text-white font-extrabold animate-pulse ml-6 mt-1">{{ $errors->first() }}</span>
        </div>
      </form>
  </div>
</div>
<div class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex" wire:keydown.escape="closeModal()">
    <div class="flex mx-auto max-w-7xl items-start overflow-y-auto">
      <form>
      @csrf
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-tl-lg">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Reference:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Ref" wire:model="ref">
                      @error('ref') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Date:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Date" wire:model="date">
                      @error('date') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Description:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Description" wire:model="description">
                      @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-tr-lg">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Type:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Type" wire:model="type_id">
                      @error('type_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col">

          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Document ID:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter doc" wire:model="document_id">
                      @error('document_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account" wire:model="account_id">
                      @error('account_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Debit" wire:model="debit">
                      @error('debit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Credit" wire:model="credit">
                      @error('credit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>

        </div>





        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col">

          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Document ID:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter doc" wire:model="document_id">
                      @error('document_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account" wire:model="account_id">
                      @error('account_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Debit" wire:model="debit">
                      @error('debit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Credit" wire:model="credit">
                      @error('credit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>

        </div>
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col">

          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Document ID:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter doc" wire:model="document_id">
                      @error('document_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account" wire:model="account_id">
                      @error('account_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Debit" wire:model="debit">
                      @error('debit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Credit" wire:model="credit">
                      @error('credit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>

        </div>
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col">

          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Document ID:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter doc" wire:model="document_id">
                      @error('document_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account" wire:model="account_id">
                      @error('account_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Debit" wire:model="debit">
                      @error('debit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Credit" wire:model="credit">
                      @error('credit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>

        </div>
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col">

          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Document ID:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter doc" wire:model="document_id">
                      @error('document_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account" wire:model="account_id">
                      @error('account_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Debit" wire:model="debit">
                      @error('debit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Credit" wire:model="credit">
                      @error('credit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>

        </div>
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col">

          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Document ID:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter doc" wire:model="document_id">
                      @error('document_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Account" wire:model="account_id">
                      @error('account_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Debit" wire:model="debit">
                      @error('debit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Credit" wire:model="credit">
                      @error('credit') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>

        </div>
















        <div class=" bg-gray-400 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
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
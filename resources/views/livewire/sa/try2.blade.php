<div class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex" x-data x-init="$refs.desc.focus()">
    <div class="flex mx-auto max-w-7xl items-start mt-10 mb-10 overflow-y-auto" wire:keydown.escape="closeModal()">
      <form>
      @csrf
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row w-full bg-white rounded-t-lg">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-tl-lg">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Reference:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="ref">
                      @error('ref') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Date (YYYY-MM-DD):</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="date">
                      @error('date') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-tr-lg">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Description:</label>
                      <input type="text"  class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="description" x-ref="desc">
                      @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col w-full bg-white">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mb-4">
                    <label class="block text-white text-sm font-bold mb-2">Account:</label>
                    <select wire:model="account_id.0" class="shadow w-full py-2 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Choose an Account:</option>
                        @foreach($accounts as $account)
                            <option value={{ $account->id }}>{{ $account->name }}</option>
                        @endforeach
                    </select>
                    @error('account_id.0') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="debit.0">
                      @error('debit.0') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="credit.0">
                      @error('credit.0') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col w-full bg-white">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                    <select wire:model="account_id.1" class="shadow w-full py-2 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Choose an Account:</option>
                        @foreach($accounts as $account)
                            <option value={{ $account->id }}>{{ $account->name }}</option>
                        @endforeach
                    </select>
                    @error('account_id.1') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="debit.1">
                      @error('debit.1') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="credit.1">
                      @error('credit.1') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <x-jet-button class="" wire:click.prevent="add({{$i}})">Add</x-jet-button>
          </div>
        </div>

        @foreach($inputs as $key => $value)
        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col w-full bg-white">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                    <select wire:model="account_id.{{$value}}" class="shadow w-full py-2 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Choose an Account:</option>
                        @foreach($accounts as $account)
                            <option value={{ $account->id }}>{{ $account->name }}</option>
                        @endforeach
                    </select>
                    @error('account_id.'.$value) <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label>{{$key}}{{$value}}<br><?php print_r($debit); ?></label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="debit.{{$value}}">
                      @error('debit.'.$value) <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label>{{$key}}{{$value}}<br><?php print_r($credit); ?></label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="credit.{{$value}}">
                      @error('credit.'.$value) <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <x-jet-button class="" wire:click.prevent="remove({{$key}})">remove</x-jet-button>
          </div>
        </div>
        @endforeach

        <div class="flex flex-col lg:flex-row xl:flex-row md:flex-row sm:flex-col w-full bg-white">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Difference:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="diff">
                      @error('diff') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Debit Total:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="dtotal">
                      @error('dtotal') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                  <div class="mb-4">
                      <label class="block text-white text-sm font-bold mb-2">Credit Total:</label>
                      <input type="text" class="shadow appearance-none rounded w-full py-2 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="ctotal">
                      @error('ctotal') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
        </div>

        <div class=" bg-gray-400 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
          <div class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </div>
          <div class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </div>
        </div>

      </form>
    </div>
</div>
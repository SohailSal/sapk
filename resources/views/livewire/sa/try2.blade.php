<div class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex" x-data x-init="$refs.desc.focus()">
    <div class="flex mx-auto items-start mt-10 mb-10 overflow-auto" wire:keydown.escape="closeModal()">
      <form>
      @csrf
        <div class="flex flex-col md:flex-row bg-gray-800 rounded-t-lg">
          <div class="bg-gray-800 px-4 pt-1 pb-1 rounded-tl-lg">
            <div class="flex-row">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Reference:</label>
                      <select wire:model="type_id" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                          @foreach($types as $type)
                              <option value={{ $type->id }}>{{ $type->name }}</option>
                          @endforeach
                      </select>
                      @error('type_id') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
                  <div class="mb-1">
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="ref" disabled>
                      @error('ref') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Date (YYYY-MM-DD):</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="date">

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1 rounded-tr-lg">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Description:</label>
                      <textarea row='2' class="shadow resize-none appearance-none rounded w-80 py-2 px-4 mr-1 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="description" x-ref="desc"></textarea>

                  </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col md:flex-row bg-gray-800">
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-2">Account:</label>
                    <select wire:model="account_id.0" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Choose an Account:</option>
                        @foreach($accounts as $account)
                            <option value={{ $account->id }}>{{ $account->name }} - {{ $account->accountGroup->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Debit:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="debit.0">

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Credit:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="credit.0">

                  </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col md:flex-row bg-gray-800">
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                    <select wire:model="account_id.1" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Choose an Account:</option>
                        @foreach($accounts as $account)
                            <option value={{ $account->id }}>{{ $account->name }} - {{ $account->accountGroup->name }}</option>
                        @endforeach
                    </select>

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="debit.1">

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="credit.1">

                  </div>
            </div>
          </div>
        </div>

        @foreach($inputs as $key => $value)
        <div class="flex flex-col md:flex-row bg-gray-800">
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                    <select wire:model="account_id.{{$value}}" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value=''>Choose an Account:</option>
                        @foreach($accounts as $account)
                            <option value={{ $account->id }}>{{ $account->name }} - {{ $account->accountGroup->name }}</option>
                        @endforeach
                    </select>

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
<!--                      <label>{{$key}}{{$value}}<br><?php print_r($debit); ?></label> -->
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="debit.{{$value}}">

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
<!--                      <label>{{$key}}{{$value}}<br><?php print_r($credit); ?></label> -->
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="credit.{{$value}}">

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
              <button class="bg-red-800 border border-gray-500 rounded-lg text-white hover:bg-red-900 px-3" wire:click.prevent="remove({{$key}})">Remove</button>
          </div>
        </div>
        @endforeach

        <div class="flex flex-col md:flex-row bg-gray-800">
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Difference:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="diff" disabled>

                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Debit Total:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="dtotal" disabled>
                      @error('dtotal') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
          <div class="bg-gray-800 px-4 pt-1 pb-1">
            <div class="">
                  <div class="mb-1">
                      <label class="block text-white text-sm font-bold mb-2">Credit Total:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model="ctotal" disabled>
                      @error('ctotal') <span class="text-red-500">{{ $message }}</span>@enderror
                  </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-400 px-4 py-2 sm:px-6 sm:flex sm:flex-row rounded-b-lg">
          <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </div>
          <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </div>
          <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click.prevent="add({{$i}})" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 mx-3 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Add row
            </button>
          </div>
              <span class="inline-flex text-white font-extrabold animate-pulse ml-6 mt-1">{{ $errors->first() }}</span>
        </div>
      </form>
    </div>
</div>
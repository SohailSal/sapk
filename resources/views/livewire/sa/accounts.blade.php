<x-slot name="header">
<div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Accounts
        </div>
        <div class="inline-flex  bg-gray-600 rounded-lg">
            <form method="GET" action="{{ url('account') }}">
            @csrf
                <div class="inline-flex">
                    <select name="company" class="w-52 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                        @foreach(\Auth::user()->companies as $company)
                            <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inline-flex">
                    <button class="bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline px-4 hover:text-blue-200" type="submit">Go</button>
                </div>
            </form>
        </div>
    </div>
</x-slot>
<div class=" bg-gray-600">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg bg-gray-800 shadow-lg px-3 py-3 mt-3">
            @if (session()->has('message'))
                <div class="bg-indigo-100 border-t-4 border-indigo-500 rounded-b text-indigo-900 px-4 shadow-md " role="alert">
                  <div class="flex-1 align-middle">
                    <div>
                      <p class="text-sm py-2">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <div class="flex items-center justify-between">
              @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())
              <x-jet-button class="flex-wrap mb-2 border" wire:click="create()">Create New Account</x-jet-button>
              @endcannot
                @if($isOpen)
                    @include('livewire.sa.accountcreate')
                @endif
                <div class="">
                      <label class="block text-white text-sm font-bold mb-2">Account:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="search">
                </div>
                <span class="flex-wrap ml-5">{{$accounts->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">ID</th>
                        <th class="px-4 py-1">Name of Account</th>
                        <th class="px-4 py-1">Group of Account</th>
                        <th class="px-4 py-1 text-center w-auto">Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ $account->id }}</td>
                        <td class="border px-4 py-1">{{ $account->name }}</td>
                        <td class="border px-4 py-1">{{ $account->accountGroup->name }}</td>
                        <td class="border px-4 py-1">
                        <div class="flex justify-between">
                            <a href="{{('ledger/'.Crypt::encrypt($account->id))}}" target="_blank" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white hover:no-underline">Ledger in PDF</a>
                            <x-jet-button wire:click="edit({{ $account->id }})" >Edit</x-jet-button>
                            @if(count($account->entries)==0)<x-jet-danger-button class="delbutton" wire:click.prevent="delete({{ $account->id }})">Delete</x-jet-danger-button>@endif
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


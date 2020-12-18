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
<div class="py-2 bg-gray-600">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg bg-gray-800 shadow-lg px-3 py-3 mt-3">
            @if (session()->has('message'))
                <div class="bg-indigo-100 border-t-4 border-indigo-500 mb-2 rounded-b text-indigo-900 px-4 shadow-md " role="alert">
                  <div class="flex-1 align-middle">
                    <div>
                      <p class="text-sm py-2">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <div class="flex items-center justify-between">
                <span class="flex">
                @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())
                <button class="flex-wrap mb-2 mr-2 px-2 py-1 border border-indigo-600 rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:shadow-outline" wire:click="create()">New Account</button>
                @endcannot
                @if($isOpen)
                    @include('livewire.sa.accountcreate')
                @endif
                <div class="flex-1">
                      <input type="text" class="shadow appearance-none rounded w-36 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" placeholder="Account Name" wire:model="search">
                </div>
                <div class="flex-1">
                      <input type="text" class="shadow appearance-none rounded w-36 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" placeholder="Group Name" wire:model="search2">
                </div>
                </span>
                <span class="flex-wrap ml-5">{{$accounts->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">Number</th>
                        <th class="px-4 py-1">Name of Account</th>
                        <th class="px-4 py-1">Group of Account</th>
                        <th class="px-4 py-1 text-center w-2/6" colspan="3">Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ $account->number }}</td>
                        <td class="border px-4 py-1">{{ $account->name }}</td>
                        <td class="border px-4 py-1">{{ $account->groupName }}</td>
                        <td class="border-b px-4 text-center">
                            <a href="{{('ledger/'.Crypt::encrypt($account->id))}}" target="_blank" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline whitespace-no-wrap">Ledger in PDF</a>
                        </td>
                        <td class="border-b px-4 text-center">
                            <button wire:click="edit({{ $account->id }})" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Edit</button>
                        </td>
                        <td class="border-b border-r px-4 text-center">
                            @if(count(App\Models\Account::where('id',$account->id)->first()->entries)==0)<button class="delbutton bg-red-600 hover:bg-red-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline" wire:click.prevent="delete({{ $account->id }})" >Delete</button>@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


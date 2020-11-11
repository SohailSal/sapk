<x-slot name="header">
<div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Entries
        </div>
        <div class="inline-flex  bg-gray-600 rounded-lg">
            <form method="GET" action="{{ route('dashboard') }}">
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
<div class="py-3 bg-gray-600">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg bg-gray-800 shadow-lg px-3 py-3">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <x-jet-button class="mb-2 border" wire:click="create()">Create New Entry</x-jet-button>
            @if($isOpen)
                @include('livewire.sa.entrycreate')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">No.</th>
                        <th class="px-4 py-1">Voucher</th>
                        <th class="px-4 py-1">Account</th>
                        <th class="px-4 py-1">Debit</th>
                        <th class="px-4 py-1">Credit</th>
                        <th class="px-4 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ ++$ite }}</td>
                        <td class="border px-4 py-1">{{ $entry->document->ref }}</td>
                        <td class="border px-4 py-1">{{ $entry->account->name }}</td>
                        <td class="border px-4 py-1">{{ $entry->debit }}</td>
                        <td class="border px-4 py-1">{{ $entry->credit }}</td>
                        <td class="border px-4 py-1">
                        <x-jet-button wire:click="edit({{ $entry->id }})" >Edit</x-jet-button>
                        <x-jet-danger-button wire:click="delete({{ $entry->id }})" >Delete</x-jet-danger-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
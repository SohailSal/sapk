<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        Entries
    </h2>
</x-slot>
<div class="py-6 bg-gray-600">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg bg-gray-800 shadow-lg px-4 py-4">
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
                        <th class="px-4 py-1 w-20">No.</th>
                        <th class="px-4 py-1">DB ID</th>
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
                        <td class="border px-4 py-1">{{ $entry->id }}</td>
                        <td class="border px-4 py-1">{{ $entry->document->ref }}</td>
                        <td class="border px-4 py-1">{{ $entry->account->name }}</td>
                        <td class="border px-4 py-1">{{ $entry->debit }}</td>
                        <td class="border px-4 py-1">{{ $entry->credit }}</td>
                        <td class="border px-4 py-1">
                        <x-jet-secondary-button wire:click="edit({{ $entry->id }})" >Edit</x-jet-secondary-button>
                        <x-jet-danger-button wire:click="delete({{ $entry->id }})" >Delete</x-jet-danger-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
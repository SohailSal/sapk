<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Account Groups
    </h2>
</x-slot>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <x-jet-button class="mb-2" wire:click="create()">Create New Group</x-jet-button>
            @if($isOpen)
                @include('livewire.sa.groupcreate')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1 w-20">No.</th>
                        <th class="px-4 py-1">DB ID</th>
                        <th class="px-4 py-1">Type</th>
                        <th class="px-4 py-1">Name</th>
                        <th class="px-4 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td class="border px-4 py-1">{{ ++$ite }}</td>
                        <td class="border px-4 py-1">{{ $group->id }}</td>
                        <td class="border px-4 py-1">{{ $group->accountType->name }}</td>
                        <td class="border px-4 py-1">{{ $group->name }}</td>
                        <td class="border px-4 py-1">
                        <x-jet-secondary-button wire:click="edit({{ $group->id }})" >Edit</x-jet-secondary-button>
                        <x-jet-danger-button wire:click="delete({{ $group->id }})" >Delete</x-jet-danger-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

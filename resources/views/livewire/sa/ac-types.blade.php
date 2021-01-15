<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        SA Accounting
    </h2>
</x-slot>
<div class=" bg-gray-600" x-data x-init="$refs.go.focus()">
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
            <x-jet-button x-ref="go" class="mb-2 border" wire:click="create()">Create New Type</x-jet-button>
            @if($isOpen)
                @include('livewire.sa.typecreate')
            @endif
            <div class="overflow-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-1 w-20">No.</th>
                            <th class="px-4 py-1">DB ID</th>
                            <th class="px-4 py-1">Name</th>
                            <th class="px-4 py-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $type)
                        <tr class="text-white">
                            <td class="border px-4 py-1">{{ ++$ite }}</td>
                            <td class="border px-4 py-1">{{ $type->id }}</td>
                            <td class="border px-4 py-1">{{ $type->name }}
                            {{$type->accountGroups->isEmpty()?"yes":"no"}}
                            </td>
                            <td class="border px-4 py-1">
                            <x-jet-button wire:click="edit({{ $type->id }})" >Edit</x-jet-button>
                            <x-jet-danger-button wire:click="delete({{ $type->id }})" >Delete</x-jet-danger-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
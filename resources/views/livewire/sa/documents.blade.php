<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        Journal Voucher
    </h2>
</x-slot>
<div class="py-6 bg-gray-600" x-data x-init="$refs.go.focus()">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg  bg-gray-800 shadow-lg px-4 py-4 ">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <x-jet-button x-ref="go" class="mb-2 border" wire:click="create()">Create New Document</x-jet-button>
            @if($isOpen)
                @include('livewire.sa.try')
            @endif
            <a class="border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('tb')}}">Trial Balance</a>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1 w-20">No.</th>
                        <th class="px-4 py-1">DB ID</th>
                        <th class="px-4 py-1">Reference</th>
                        <th class="px-4 py-1">Date</th>
                        <th class="px-4 py-1">Description</th>
                        <th class="px-4 py-1">Type</th>
                        <th class="px-4 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docs as $doc)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ ++$ite }}</td>
                        <td class="border px-4 py-1">{{ $doc->id }}</td>
                        <td class="border px-4 py-1">{{ $doc->ref }}</td>
                        <td class="border px-4 py-1">{{ $doc->date }}</td>
                        <td class="border px-4 py-1">{{ $doc->description }}</td>
                        <td class="border px-4 py-1">{{ $doc->documentType->name }}</td>
                        <td class="border px-4 py-1">
                        <x-jet-danger-button wire:click="delete({{ $doc->id }})" >Delete</x-jet-danger-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        Companies
    </h2>
</x-slot>
<div class="py-6 bg-gray-600" x-data x-init="$refs.go.focus()">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-auto sm:rounded-lg  bg-gray-800 shadow-lg px-4 py-4 ">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <div class="flex items-center justify-between">
            <x-jet-button x-ref="go" class="flex-wrap mb-2 border" wire:click="create()">Create New Company</x-jet-button>
            @if($isOpen)
                @include('livewire.sa.cocreate')
            @endif
            <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('tb')}}">Trial Balance</a>
            <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('first-chart')}}">Chart</a>
            <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('excel')}}">Excel</a>
            <span class="flex-wrap ml-5">{{$docss->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1 w-20">No.</th>
                        <th class="px-4 py-1">DB ID</th>
                        <th class="px-4 py-1">Name</th>
                        @can('isAdmin')<th class="px-4 py-1">Action</th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($docss as $doc)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ ++$ite }}</td>
                        <td class="border px-4 py-1">{{ $doc->id }}</td>
                        <td class="border px-4 py-1">{{ $doc->name }}</td>
                        @can('isAdmin')
                        <td class="border px-4 py-1">
                        <x-jet-button wire:click="edit({{ $doc->id }})" >Edit</x-jet-button>
                        <x-jet-danger-button wire:click="delete({{ $doc->id }})" >Delete</x-jet-danger-button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
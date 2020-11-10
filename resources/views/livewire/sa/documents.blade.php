<x-slot name="header">
<div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Vouchers
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
            <x-jet-button x-ref="go" class="flex-wrap mb-2 border" wire:click="create()">Create New Voucher</x-jet-button>
            @if($isOpen)
                @include('livewire.sa.try2')
            @endif
            <span class="flex-wrap ml-5">{{$docss->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">Reference</th>
                        <th class="px-4 py-1">Type</th>
                        <th class="px-4 py-1">Date</th>
                        <th class="px-4 py-1">Description</th>
                        @can('isAdmin')<th class="px-4 py-1">Action</th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($docss as $doc)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ $doc->ref }}</td>
                        <td class="border px-4 py-1">{{ $doc->documentType->name }}</td>
                        <td class="border px-4 py-1">{{ $doc->date }}</td>
                        <td class="border px-4 py-1">{{ $doc->description }}</td>
                        @can('isAdmin')
                        <td class="border px-4 py-1">
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
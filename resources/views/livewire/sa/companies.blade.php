<x-slot name="header">
<div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Companies
        </div>
        <div class="inline-flex  bg-gray-600 rounded-lg">
            <form method="GET" action="{{ url('company') }}">
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
<div class="py-2 bg-gray-600" x-data x-init="$refs.go.focus()">
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
            <button x-ref="go" class="flex-wrap mb-2 px-2 py-1 border border-white rounded-lg text-white" wire:click="create()">Create New Company</button>
            @if($isOpen)
                @include('livewire.sa.cocreate')
            @endif
            <span class="flex-wrap ml-5">{{$docss->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">No.</th>
                        <th class="px-4 py-1">Name</th>
                        <th class="px-4 py-1">Address</th>
                        <th class="px-4 py-1">Email</th>
                        <th class="px-4 py-1">Website</th>
                        <th class="px-4 py-1">Phone</th>
                        <th class="px-4 py-1 text-center w-auto">Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docss as $doc)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ ++$ite }}</td>
                        <td class="border px-4 py-1">{{ $doc->name }}</td>
                        <td class="border px-4 py-1">{{ $doc->address }}</td>
                        <td class="border px-4 py-1">{{ $doc->email }}</td>
                        <td class="border px-4 py-1">{{ $doc->web }}</td>
                        <td class="border px-4 py-1">{{ $doc->phone }}</td>
                        <td class="border px-4 py-1">
                        <div class="flex justify-between">
                        @cannot('isUser', $doc)
                            <x-jet-button wire:click="edit({{ $doc->id }})" >Edit</x-jet-button>
                            @if(count($doc->accountGroups)==0 && count($doc->documentTypes)==0)<x-jet-danger-button wire:click="delete({{ $doc->id }})" >Delete</x-jet-danger-button>@endif
                        @endcannot
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
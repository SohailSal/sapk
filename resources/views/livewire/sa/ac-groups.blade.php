<x-slot name="header">
    <div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Account Groups
        </div>
        <div class="inline-flex  bg-gray-600 rounded-lg">
            <form method="GET" action="{{ url('group') }}">
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
            <div class="flex place-items-auto justify-between">
            @if (!\App\Models\AccountGroup::where('company_id',session('company_id'))->count())
            <a class="px-4 py-2 flex-wrap mb-2 border bg-gray-600 text-white rounded-lg" href="{{url('generate')}}">Auto Generate</a>
            @endif
            @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())
            <button class="flex-wrap mb-2 mr-2 px-2 py-1 border border-indigo-600 rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:shadow-outline" wire:click="create()">Create New Group</button>
            @endcannot
                @if($isOpen)
                    @include('livewire.sa.groupcreate')
                @endif
                <span class="flex-wrap ml-5">{{$groups->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">Group Name</th>
                        <th class="px-4 py-1">Group Type</th>
                        <th class="px-4 py-1 text-center w-2/6" colspan="2">Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ $group->name }}</td>
                        <td class="border px-4 py-1">{{ $group->accountType->name }}</td>
                        <td class="border-b px-4 text-center">
                            <button wire:click="edit({{ $group->id }})" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Edit</button>
                        </td>
                        <td class="border-b border-r px-4 text-center">
                            @if(count($group->accounts)==0)<button wire:click="delete({{ $group->id }})" class="delbutton bg-red-600 hover:bg-red-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Delete</button>@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

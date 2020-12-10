<x-slot name="header">
<div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Transactions
        </div>
        <div class="inline-flex  bg-gray-600 rounded-lg">
            <form method="GET" action="{{ url('doc') }}">
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
            <div class="flex items-center justify-between">
                @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())
                <button x-ref="go" class="flex-wrap mb-2 px-2 py-1 border border-white rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:shadow-outline-indigo" wire:click="create()">New Entry</button>
                @endcannot
                @if($isOpen)
                    @if(App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first()->closed == 0)
                        @include('livewire.sa.try2')
                    @else
                        <script> alert('Can\'t enter! This fiscal year is Closed.') </script>
                    @endif
                @endif
                <div class="">
                      <label class="block text-white text-sm font-bold mb-2">Ref:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="search1">
                </div>
                <div class="">
                      <label class="block text-white text-sm font-bold mb-2">Description:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="search2">
                </div>
                <div class="">
                      <label class="block text-white text-sm font-bold mb-2">Start date:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="search3">
                </div>
                <div class="">
                      <label class="block text-white text-sm font-bold mb-2">End date:</label>
                      <input type="text" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:shadow-outline-indigo" wire:model.lazy="search4">
                </div>
                <span class="flex-wrap ml-5">{{$docss->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">Reference</th>
                        <th class="px-4 py-1">Type</th>
                        <th class="px-4 py-1">Date</th>
                        <th class="px-4 py-1">Description</th>
                        @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())<th class="px-4 py-1 text-center w-auto">Tasks</th>@endcannot
                    </tr>
                </thead>
                <tbody>
                    @foreach($docss as $doc)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ $doc->ref }}</td>
                        <td class="border px-4 py-1">{{ $doc->documentType->name }}</td>
                        <td class="border px-4 py-1">{{ $doc->date }}</td>
                        <td class="border px-4 py-1">{{ $doc->description }}</td>
                        @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())
                        <td class="border px-4 py-1">
                        <div class="flex justify-between">
                            <a href="{{url('voucher/'.Crypt::encrypt($doc->id))}}" target="_blank" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white">Voucher in PDF</a>
                            @if(App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first()->closed == 0)
                                <x-jet-button wire:click="edit({{ $doc->id }})" >Edit</x-jet-button>
                                <x-jet-danger-button wire:click="delete({{ $doc->id }})" >Delete</x-jet-danger-button>
                            @endif
                        </div>
                        </td>
                        @endcannot
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-slot name="header">
<div class="flex mx-auto items-center justify-between">
        <div class="inline-flex font-semibold text-xl text-white leading-tight">
            Entries
        </div>
        <div class="inline-flex  bg-gray-600 rounded-lg">
            <form method="GET" action="{{ url('entry') }}">
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
                <div class="bg-indigo-100 border-t-4 border-indigo-500 rounded-b text-indigo-900 px-4 shadow-md " role="alert">
                  <div class="flex-1 align-middle">
                    <div>
                      <p class="text-sm py-2">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <div class="flex items-center justify-between">
<!--                <x-jet-button class="flex-wrap mb-2 border" wire:click="create()">Create New Entry</x-jet-button>
                @if($isOpen)
                    @include('livewire.sa.entrycreate')
                @endif
-->
                <span class="flex">
                    <div class="flex-1">
                        <select wire:model="search1" class="shadow appearance-none rounded w-48 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline">
                            <option value=''>Choose an Account:</option>
                            @foreach(\App\Models\Account::where('company_id',session('company_id'))->get() as $account)
                                <option value={{ $account->id }}>{{ $account->name }} - {{ $account->accountGroup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                            <span class=" date" id="dstart">
                            <input type="text" id="istart" onkeydown="return allow(event)" class="shadow appearance-none rounded w-28 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" wire:model="search2">
                            </span>
                    </div>
                    <div class="flex-1">
                            <span class=" date" id="dend">
                            <input type="text" id="iend" onkeydown="return allow(event)" class="shadow appearance-none rounded w-28 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" wire:model="search3">
                            </span>
                    </div>
                </span>    
                <span class="flex-wrap ml-5">{{$entries->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">Voucher</th>
                        <th class="px-4 py-1">Date</th>
                        <th class="px-4 py-1">Description</th>
                        <th class="px-4 py-1">Debit</th>
                        <th class="px-4 py-1">Credit</th>
<!--                        <th class="px-4 py-1">Action</th>   -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                    <tr class="text-white">
                        <td class="border px-4 py-1">{{ $entry->ref }}</td>
                        <td class="border px-4 py-1">{{ $entry->date }}</td>
                        <td class="border px-4 py-1">{{ $entry->description }}</td>
                        <td class="border px-4 py-1">{{ $entry->debit }}</td>
                        <td class="border px-4 py-1">{{ $entry->credit }}</td>
<!--                        <td class="border px-4 py-1">
                        <x-jet-button wire:click="edit({{ $entry->id }})" >Edit</x-jet-button>
                        <x-jet-danger-button wire:click="delete({{ $entry->id }})" >Delete</x-jet-danger-button>
                        </td>
-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
            $(document).ready(function() {

        <?php $year = \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first(); ?>
        var start = "<?php echo $year->begin; ?>";
        var end = "<?php echo $year->end; ?>";
        var startf = new Date(start);
        var endf = new Date(end);

            $('.date').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    startDate: startf ,
                    endDate: endf ,
                    immediateUpdates: true,
                });

            $('#dstart').datepicker().on('change', function (e) {
                $('#istart').change(e);
            });

            $('#istart').change(function(e){
                $('#dstart').datepicker('hide');
                @this.set('search2', e.target.value);
            });

            $('#dend').datepicker().on('change', function (e) {
                $('#iend').change(e);
            });

            $('#iend').change(function(e){
                $('#dend').datepicker('hide');
                @this.set('search3', e.target.value);
            });
        });

        function allow(e) {
            if (event.keyCode == 9) {
              // tab key allowed
                return true;
            } else {
                return false;
            }
        }
    </script>
</div>
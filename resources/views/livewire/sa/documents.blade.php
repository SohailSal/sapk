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
<div class="py-2 bg-gray-600" x-data x-init="$refs.go.focus()">
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
            <div class="flex items-center justify-between">
                <span class="flex">
                @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())
                <button x-ref="go" class="flex-wrap mb-2 mr-2 px-2 py-1 border border-indigo-600 rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:shadow-outline" wire:click="create()">New Transaction</button>
                @endcannot
                @if($isOpen)
                    @if(App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first()->closed == 0)
                        @include('livewire.sa.try2')
                    @else
                        <script> alert('Can\'t enter! This fiscal year is Closed.') </script>
                    @endif
                @endif
                <div class="flex-1">
                      <input type="text" class="shadow appearance-none rounded w-32 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" placeholder="Search by Ref" wire:model.lazy="search1">
                </div>
                <div class="flex-1">
                      <input type="text" class="shadow appearance-none rounded w-44 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" placeholder="Search by Description" wire:model.lazy="search2">
                </div>
                <div class="flex-1">
                      <span class="date" id="dstart">
                          <input type="text" id="istart" onkeydown="return allow(event)" class="shadow appearance-none rounded w-28 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" wire:model.lazy="search3">
                      </span>
                </div>
                <div class="flex-1">
                      <span class="date" id="dend">
                          <input type="text" id="iend" onkeydown="return allow(event)" class="shadow appearance-none rounded w-28 py-1 px-1 mb-2 mr-2 bg-gray-600 text-white focus:outline-none focus:shadow-outline" wire:model.lazy="search4">
                      </span>
                </div>
                </span>
                <span class="flex-wrap ml-5">{{$docss->links()}}</span>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">Reference</th>
                        <th class="px-4 py-1">Type</th>
                        <th class="px-4 py-1">Date</th>
                        <th class="px-4 py-1">Description</th>
                        @cannot('isUser', App\Models\Company::where('id',session('company_id'))->first())<th class="px-4 py-1 text-center w-2/6" colspan="3">Tasks</th>@endcannot
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
                        <td class="border-b px-4 text-center">
                            <a href="{{url('voucher/'.Crypt::encrypt($doc->id))}}" target="_blank" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline whitespace-no-wrap">Voucher in PDF</a>
                        </td>
                            @if(App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first()->closed == 0)
                        <td class="border-b px-4 text-center">
                            <button wire:click="edit({{ $doc->id }})" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Edit</button>
                        </td>
                        <td class="border-b border-r px-4 text-center">
                            <button wire:click="delete({{ $doc->id }})" class="delbutton bg-red-600 hover:bg-red-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Delete</button>
                        </td>
                            @endif

                        @endcannot
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
                @this.set('search3', e.target.value);
            });

            $('#dend').datepicker().on('change', function (e) {
                $('#iend').change(e);
            });

            $('#iend').change(function(e){
                $('#dend').datepicker('hide');
                @this.set('search4', e.target.value);
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
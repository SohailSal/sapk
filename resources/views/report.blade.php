<x-app-layout>
    <x-slot name="header">
      <div class="flex mx-auto items-center justify-between">
          <div class="inline-flex font-semibold text-xl text-white leading-tight">
              Reports
          </div>
          <div class="inline-flex  bg-gray-600 rounded-lg">
              <form method="GET" action="{{ url('report') }}">
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

<div class="py-2 bg-gray-600"">
            @if (session()->has('message'))
                <div class="bg-indigo-100 border-t-4 border-indigo-500 rounded-b text-indigo-900 px-4 shadow-md mx-4" role="alert">
                  <div class="flex-1 align-middle">
                    <div>
                      <p class="text-sm py-2">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-auto sm:rounded-lg  bg-gray-800 shadow-lg px-4 py-4 ">
            <div class="flex items-center justify-between">
                <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800 text-center " href="{{url('tb')}}">Trial Balance</a>
                <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800 text-center " href="{{url('bs')}}">Balance Sheet</a>
                <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800 text-center " href="{{url('pl')}}">Profit or Loss A/c</a>
            </div>
        </div>

        <div class="overflow-auto sm:rounded-lg  bg-gray-800 text-white shadow-lg px-4 py-2 mt-4">
        <div class="flex-col ml-2 text-xl pb-2"> Date-wise Ledger </div>
            <div class="flex items-center justify-between">
                <form method="get" action="{{ url('range') }}">
                @csrf
                    <div class="inline-flex items-center ml-2">
                        <label for="account_id">Account:</label>
                        <select class="bg-gray-600 rounded-lg mx-2 w-52" name="account_id">
                            @foreach (\App\Models\Account::where('company_id',session('company_id'))->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
<?php
    $year = \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first();
?>
                    <div class="inline-flex items-center">
                        <span class="date" id="dstart">
                            <input type="text" id="istart" onkeydown="return allow(event)" class=" bg-gray-600 rounded-lg mx-2" name="date_start" value="{{$year->begin}}"/>
                        </span>
                    </div>
                    <div class="inline-flex items-center">
                        <span class="date" id="dend">
                            <input type="text" id="iend" onkeydown="return allow(event)" class=" bg-gray-600 rounded-lg mx-2" name="date_end" value="{{$year->end}}"/>
                        </span>
                    </div>
                    <div class="inline-flex items-center">
                        <button type="submit" class="mx-2 px-3 py-1 rounded-lg border bg-gray-600 hover:bg-gray-800" name="submit">Get Ledger</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

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

            $('#dstart').datepicker().on('changeDate', function (e) {
                $('#istart').change(e);
            });

            $('#istart').change(function(e){
                $('#dstart').datepicker('hide');
                thisstart = new Date($(this).val());
            });

            $('#dend').datepicker().on('changeDate', function (e) {
                $('#iend').change(e);
            });

            $('#iend').change(function(e){
                $('#dend').datepicker('hide');
                thisend = new Date($(this).val());
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



</x-app-layout>

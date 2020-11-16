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

<div class="py-6 bg-gray-600"">
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
                <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800 text-center" href="{{url('tb')}}">Trial Balance</a>
                <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800 text-center" href="{{url('bs')}}">Balance Sheet</a>
                <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800 text-center" href="{{url('pl')}}">Profit or Loss A/c</a>
            </div>

            <div class="flex items-center justify-between">
                <form method="get" action="{{ url('range') }}">
                @csrf
                <div class="text-white">
                        <div class="flex-1">
                            <label for="date_start">Start date:</label>
                            <input type="text" class="date bg-gray-600 rounded-lg" name="date_start"/>
                        </div>
                        <div class="flex-1">
                            <label for="date_end">End date:</label>
                            <input type="text" class="date bg-gray-600 rounded-lg" name="date_end"/>
                        </div>
                        <div class="flex-1">
                            <label for="account_id">Account:</label>
                            <select class="bg-gray-600 rounded-lg" name="account_id">
                                @foreach (\App\Models\Account::where('company_id',session('company_id'))->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="submit">&nbsp;</label>
                            <button type="submit" class="px-4 py-2 rounded-lg border-solid border-2" name="submit">Get Ledger</button>
                        </div>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>



</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
        </h2>
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
            <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('tb')}}">Trial Balance</a>
            <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('first-chart')}}">Chart</a>
            <a class="flex-1 border rounded-lg bg-gray-600 p-1 m-2 text-white hover:bg-gray-800" href="{{url('excel')}}">Excel</a>
            </div>
        </div>
    </div>
</div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form method="GET" action="{{ route('dashboard') }}">
                    @csrf
                    <div class="mb-1">
                        <label class="block text-white text-sm font-bold mb-2">Select Company:</label>
                        <select name="company" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                            @foreach(\Auth::user()->companies as $company)
                                <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-button type="submit">submit</x-jet-button>
                    </form>
                </div>
            </div>
        </div>

</x-app-layout>

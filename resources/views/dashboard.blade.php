<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
        </h2>
    </x-slot>

@if(Auth::user()->companies()->first())
    <div class="text-white">Welcome, {{Auth::user()->name}}</div>
@else
    <div class="text-white">First <a href="{{url('company')}}">create a Company</a></div>
@endif
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

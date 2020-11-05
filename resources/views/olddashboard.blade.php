<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
                   @can('isAdmin')
                        <div class="btn btn-success btn-lg text-white">
                          You have Admin Access
                        </div>
                    @elsecan('isManager')
                        <div class="btn btn-primary btn-lg text-white">
                          You have Manager Access
                        </div>
                    @else
                        <div class="btn btn-info btn-lg text-white">
                          You have User Access
                        </div>
                    @endcan
                    <br>
        @if ($message = session('company_id'))
        <div class="alert alert-success bg-white">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table>
                @foreach(\App\Models\User::all() as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                    </tr>
                @endforeach
                </table>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                {{\Auth::user()->id}}
                <br>
                {{\Auth::user()->name}}
                <table>
                @foreach(\Auth::user()->companies as $company)
                    <tr>
                        <td>{{$company->name}}</td>
                    </tr>
                @endforeach
                </table>
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
                        <option value="">Choose a Company</option>
                            @foreach(\Auth::user()->companies as $company)
                                <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-button type="submit">submit</x-jet-button>
                    </form>
            </div>
        </div>
</x-app-layout>

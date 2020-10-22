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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
</x-app-layout>

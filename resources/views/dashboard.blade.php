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
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>

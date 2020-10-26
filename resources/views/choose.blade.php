<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('company_id'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('company_id') }}
            </div>
        @endif

        <form method="GET" action="{{ route('dashboard') }}">
            @csrf

            <div class="mb-1 mt-4">
                <label class="block text-white text-sm font-bold mb-2">Select Company:</label>
                <select name="company" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                    <option value=''>Choose a Company:</option>
                    @foreach(\Auth::user()->companies as $company)
                        <option value='{{ $company->id }}'>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>



            <div class="flex items-center justify-end mt-4">
                <x-jet-button type="submit" class="ml-4">
                    Choose
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

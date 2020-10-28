<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SA Accounting</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div class="fixed flex items-top bg-gray-700 dark:bg-gray-900 pt-0 inset-0">

            @if (Route::has('login'))
                <div class="flex flex-row items-center justify-between fixed px-6 py-1">
                    <div class="">
                    <a href="{{ url('/') }}" class="text-sm text-white ml-5 hover:text-blue-300 font-bold">SA Accounting</a>
                    </div>
                    <div class="fixed inset-y-0 right-0 mr-12 py-1">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-white ml-5 hover:text-blue-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-white ml-5 hover:text-blue-300">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-white ml-5 hover:text-blue-300">Register</a>
                        @endif
                    @endif
                    </div>
                </div>
            @endif

            <div class="">
                <div class="flex pt-8 h-11/12">
                   <img src="{{asset('/img/ledger.jpg')}}" class="px-2 w-full object-cover flex-wrap">
                </div>

                <div class="mt-3 text-center text-xs text-white">
                    Copyright 2020, SA Accounting
                </div>
            </div>
        </div>
    </body>
</html>

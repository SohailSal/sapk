<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SA Accounting</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div class="fixed flex items-top bg-gray-700 dark:bg-gray-900 pt-0">

            @if (Route::has('login'))
                <div class="grid grid-cols-3 items-top fixed px-6 py-1">
                    <div class="">
                    <a href="{{ url('/') }}" class="text-sm text-white ml-5 hover:text-blue-300">SA Accounting</a>
                    </div>
                    <div></div>
                    <div class="">
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

            <div class="mx-auto">
                <div class="flex justify-center pt-8">
                   <img src="{{asset('/img/ledger.jpg')}}" class="max-w-full px-4 ">
                </div>

                <div class="ml-4 text-center text-xs text-white sm:text-right sm:ml-0">
                    Copyright 2020, SA Accounting
                </div>
            </div>
        </div>
    </body>
</html>

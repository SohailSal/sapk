<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>
        <style>
        select:-webkit-autofill,
        textarea:-webkit-autofill,
        input:-webkit-autofill {
        -webkit-text-fill-color: white;
        -webkit-box-shadow: 0 0 0px 1000px #4b5563 inset;
        transition: background-color 5000s ease-in-out 0s;
        caret-color:white;
        }
        </style>
    </head>
    <body>
    <div class="flex">
        <div class="">
        <img src="{{asset('/img/ledger2.jpg')}}" class="w-screen h-screen">
        </div>
        <div class="absolute z-10 inset-y-2/12 inset-x-2/12 font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </div>
    </body>
</html>

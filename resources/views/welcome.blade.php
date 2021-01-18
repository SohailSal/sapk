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
                    <a href="{{ url('/') }}" class="text-sm text-white ml-5 hover:text-blue-300 font-bold">SA accounting</a>
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
                <div class="flex pt-8 h-11/12 z-10">
                   <img src="{{asset('/img/ledger.jpg')}}" class="px-2 w-full object-cover">
                   <div class="absolute z-20 invisible md:visible top-32 md:left-10 lg:left-60">
                        <svg id="svg8" width="178mm" height="55mm" version="1.1" viewBox="0 0 190 33.611" xmlns="http://www.w3.org/2000/svg">
                            <g id="layer1" transform="translate(-8.6366 -101.9)">
                                <rect id="rect10" x="9.6366" y="102.9" width="23.397" height="29.612" fill="none" stroke="#000" stroke-width="2"/>
                                <text id="text837" x="15.38962" y="130.41719" font-family="'Matura MT Script Capitals'" font-size="24.976px" fill="#000" stroke="#000" stroke-width="1" style="line-height:1.25" xml:space="preserve"><tspan id="tspan835" x="15.38962" y="130.41719" font-family="sans-serif" font-size="24.976px" stroke-width=".3">S</tspan></text>
                                <rect id="rect10-5" x="33.034" y="102.9" width="23.397" height="29.612" fill="none" stroke="#000" stroke-width="2"/>
                                <text id="text837-2" x="34.55349" y="130.41719" font-family="'Matura MT Script Capitals'" font-size="24.976px" fill="#000" stroke="#000" stroke-width="1" style="line-height:1.25" xml:space="preserve"><tspan id="tspan835-5" x="34.55349" y="130.41719" font-family="sans-serif" font-size="24.976px" stroke-width=".3">A</tspan></text>
                                <text id="text837-2-1" x="59.926598" y="130.34967" font-family="'Matura MT Script Capitals'" font-size="24.976px" fill="#000" stroke="#000" stroke-width="1" style="line-height:1.25" xml:space="preserve"><tspan id="tspan835-5-6" x="59.926598" y="130.34967" font-family="sans-serif" font-size="24.976px" stroke-width=".3">accounting</tspan></text>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 text-center text-xs text-white invisible md:visible">
                    Copyright 2020, SA accounting - beta 0.2.11
                </div>
            </div>
        </div>
    </body>
</html>

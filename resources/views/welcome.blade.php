<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SA Accounting</title>

    </head>
    <body>
        <div class="fixed flex items-top justify-center min-h-screen bg-gray-500 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-xl text-white underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xl text-white underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-xl text-white underline">Register</a>
                        @endif
                    @endif
                </div>
            @endif

            <div class="mx-auto">
                <div class="flex justify-center pt-12">
                   <img src="{{asset('/img/boat.jpg')}}">
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Build v{{ Illuminate\Foundation\Application::VERSION }}
                </div>
            </div>
        </div>
    </body>
</html>

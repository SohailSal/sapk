<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SA Accounting') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"  type="text/css" />

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer></script>
    
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-600">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-gray-800 shadow-solid">
                <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
        $(document).ready(function() {

        <?php $year = \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first(); ?>
        var start = "<?php echo $year->begin; ?>";
        var end = "<?php echo $year->end; ?>";
        var startf = new Date(start);
        var endf = new Date(end);

            $('.date').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    startDate: startf ,
                    endDate: endf ,
                    immediateUpdates: true,
                }).datepicker();

            $('#dstart').datepicker().on('changeDate', function (ev) {
                $('#ledgerstart').change();
            });

            $('#ledgerstart').change(function(){
                thisstart = new Date($(this).val());
                if(thisstart < startf)
                $(this).val(start);
            });

            $('#dend').datepicker().on('changeDate', function (ev) {
                $('#ledgerend').change();
            });

            $('#ledgerend').change(function(){
                thisend = new Date($(this).val());
                if(thisend > endf)
                $(this).val(end);
            });

            $(".delbutton").on("click",function(){    
                $(this).attr('disabled', true);
                return true;
            });

        });
        </script>
    </body>
</html>

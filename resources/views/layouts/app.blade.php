<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=yes">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GATEKEEPER') }}</title>
        <style>
        
      

       
        table,  td {
            width: auto%;
            table-layout: inherit;
            
        }
        th{
           

        }

        table tr:not(:first-child) {
            cursor: pointer;
            transition: all .30s ease-in-out;
        }

        table tr:not(:first-child):hover {
            background-color: #af8a43;
        }
        </style>


        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/securityDashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profilePage.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'>
        <link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
        <!-- Scripts -->
        <!--<script src="{{ asset('js/dashboard.js') }}" defer></script>-->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        
       
       

    </head>
    <body class="font-sans antialiased">
        
        <section id="wrapper">
            @include('layouts.sideNav')
            @include('layouts.navigation')

            <!-- Page Heading -->
           <!--<header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                     $header 
                </div>
            </header>-->

             <!-- SideNav -->
           

            <!-- Page Content -->
           
                <main>
                {{ $slot }}
                </main>
           
        </section>
    </body>
</html>

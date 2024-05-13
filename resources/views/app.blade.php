<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">

        <!-- Scripts -->
        @routes
        @vite(['resources/css/app.css','resources/js/app.js'])
        @inertiaHead
        
    </head>
    <body class="font-sans antialiased">
        {{-- <script>
            window.getNotifications = @json(getNotifications());
        </script> --}}
        @inertia

        
    </body>
</html>

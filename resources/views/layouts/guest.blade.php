<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Support Ticket System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="text-center">
            <h1 class="text-5xl font-extrabold text-gray-800 dark:text-gray-200">
                Support Ticket System
            </h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                Your one-stop solution for managing support tickets
            </p>
        </div>

        <div class="w-full sm:max-w-md mt-8 px-8 py-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

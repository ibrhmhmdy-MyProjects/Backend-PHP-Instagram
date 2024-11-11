<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    {{-- <x-application-logo class="w-48 max-w-48 h-auto fill-current text-gray-600" /> --}}
                    {{-- <img src={{asset('storage').'/instagram-logo.webp'}} alt="" class="w-60 h-60 text-gray-600"> --}}
                    <h4 class="my-12 text-6xl text-center text-orange-600">Insta<span class="text-gray-600">Clone</span></h4>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-0 px-6 py-2 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

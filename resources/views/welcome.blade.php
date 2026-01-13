<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Tehnički Pregled') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-background text-gray-900 font-sans">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <!-- Logo area -->
        <div class="mb-8 text-center">
            <x-application-logo class="w-24 h-24 fill-current text-primary-600 mx-auto" />
            <h1 class="mt-6 text-4xl font-bold text-gray-900 tracking-tight">Tehnički Pregled</h1>
            <p class="text-gray-500 mt-3 text-lg">Zakazivanje pregleda nikad nije bilo lakše.</p>
        </div>

        <!-- Card -->
        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-surface border border-gray-200 shadow-sharp sm:rounded-lg text-center">
            @auth
                <div class="space-y-4">
                    <p class="text-gray-600 mb-6 font-medium">Dobrodošli nazad, {{ Auth::user()->name }}!</p>

                    <a href="{{ route('booking.create') }}"
                        class="block w-full py-3 bg-primary-600 text-white rounded-md font-bold uppercase tracking-wide hover:bg-primary-700 transition shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Zakaži Termin
                    </a>

                    <a href="{{ url('/dashboard') }}"
                        class="block w-full py-3 bg-gray-50 text-gray-700 border border-gray-300 rounded-md font-semibold hover:bg-gray-100 transition">
                        Moj Nalog
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    <a href="{{ route('login') }}"
                        class="block w-full py-3 bg-primary-600 text-white rounded-md font-bold uppercase tracking-wide hover:bg-primary-700 transition shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Prijavi se
                    </a>

                    <div class="relative flex py-3 items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-400 text-sm font-medium">Nemaš nalog?</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <a href="{{ route('register') }}"
                        class="block w-full py-3 bg-white border border-primary-600 text-primary-600 rounded-md font-bold uppercase tracking-wide hover:bg-primary-50 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Registracija
                    </a>
                </div>
            @endauth
        </div>
    </div>
</body>

</html>
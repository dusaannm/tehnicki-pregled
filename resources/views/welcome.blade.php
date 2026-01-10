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

<body class="antialiased bg-gray-100 text-gray-900 font-sans">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <!-- Logo area -->
        <div class="mb-6 text-center">
            <x-application-logo class="w-20 h-20 fill-current text-red-600 mx-auto" />
            <h1 class="mt-4 text-3xl font-bold text-gray-900">Tehnički Pregled</h1>
            <p class="text-gray-500 mt-2">Zakazivanje pregleda nikad nije bilo lakše.</p>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg text-center">
            @auth
                <div class="space-y-4">
                    <p class="text-gray-600 mb-4">Dobrodošli nazad, {{ Auth::user()->name }}!</p>

                    <a href="{{ route('booking.create') }}"
                        class="block w-full py-3 bg-red-600 text-white rounded-lg font-bold uppercase tracking-wide hover:bg-red-500 transition shadow-md">
                        Zakaži Termin
                    </a>

                    <a href="{{ url('/dashboard') }}"
                        class="block w-full py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Moj Nalog
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    <a href="{{ route('login') }}"
                        class="block w-full py-3 bg-red-600 text-white rounded-lg font-bold uppercase tracking-wide hover:bg-red-500 transition shadow-md">
                        Prijavi se
                    </a>

                    <div class="relative flex py-2 items-center">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-400 text-sm">Nemaš nalog?</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    <a href="{{ route('register') }}"
                        class="block w-full py-3 bg-white border-2 border-red-600 text-red-600 rounded-lg font-bold uppercase tracking-wide hover:bg-red-50 transition">
                        Registracija
                    </a>
                </div>
            @endauth
        </div>



    </div>
</body>

</html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novi Termin (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-sm text-gray-500 mb-4">Za kreiranje termina, trenutno koristite korisnički deo
                        aplikacije (Zakaži termin) jer zahteva složenu logiku provere slotova.</p>
                    <a href="{{ route('booking.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                        Idi na Zakazivanje
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
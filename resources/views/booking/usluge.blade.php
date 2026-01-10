<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usluge') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <p class="text-gray-600">Pregledajte našu ponudu usluga tehničkog pregleda.</p>
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Prijavi se
                    </a>
                @endguest
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($usluge as $u)
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 hover:shadow-md transition relative">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-bold text-gray-900">{{ $u->naziv }}</h3>
                                @if($u->featured)
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-200">Preporučeno</span>
                                @endif
                            </div>

                            <p class="text-gray-600 text-sm mb-4 min-h-[40px]">{{ $u->opis }}</p>

                            <div class="flex items-center text-gray-500 text-sm mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $u->trajanje_min }} minuta</span>
                            </div>

                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($u->cena, 0, ',', '.') }}
                                    RSD</span>

                                @auth
                                    <a href="{{ route('booking.create', ['usluga_id' => $u->id]) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Izaberi
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400">Prijavi se za zakazivanje</span>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
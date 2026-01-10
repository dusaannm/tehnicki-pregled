<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold">Usluge</h1>
                <a href="{{ route('booking.create') }}" class="text-sm underline text-gray-600">
                    Zakaži termin
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($usluge as $u)
                    <div class="bg-white shadow-sm rounded-lg border p-5 flex flex-col gap-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="font-semibold text-lg">{{ $u->naziv }}</div>
                                <div class="text-sm text-gray-600 mt-1">{{ $u->opis }}</div>
                            </div>

                            @if($u->featured)
                                <span class="inline-flex px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Featured
                                </span>
                            @endif
                        </div>

                        <div class="font-bold">{{ number_format($u->cena, 2) }} RSD</div>

                        <div class="pt-2 mt-auto">
                            <a href="{{ route('booking.create', ['usluga' => $u->id]) }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Zakaži ovu uslugu
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>

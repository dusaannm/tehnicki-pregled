<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Upravljanje Terminima') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Datum i Vreme
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Korisnik
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Vozilo
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Usluga
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-4 text-right text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Akcije
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($termini as $t)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($t->datum)->format('d.m.Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $t->vreme }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-900 font-medium">{{ $t->user->name ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">{{ $t->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-900 font-medium">{{ $t->vozilo->marka_model ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">{{ $t->vozilo->registracija ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-700">{{ $t->usluga->naziv ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = match ($t->status) {
                                                'approved' => 'bg-green-100 text-green-800 border-green-200',
                                                'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                                'done' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                default => 'bg-yellow-100 text-yellow-800 border-yellow-200', // pending
                                            };
                                            $statusLabel = match ($t->status) {
                                                'approved' => 'Potvrđen',
                                                'cancelled' => 'Otkazan',
                                                'done' => 'Završeno',
                                                default => 'Na čekanju',
                                            };
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full border {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('admin.termini.edit', $t) }}"
                                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-md hover:bg-indigo-100 transition duration-150">
                                                Izmeni
                                            </a>

                                            <form action="{{ route('admin.termini.destroy', $t) }}" method="POST"
                                                onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj termin?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-md hover:bg-red-100 transition duration-150">
                                                    Obriši
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($termini->isEmpty())
                        <div class="p-6 text-center text-gray-500">
                            Nema zakazanih termina.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
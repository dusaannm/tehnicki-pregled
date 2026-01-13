<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Upravljanje Terminima') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-surface overflow-hidden shadow-sharp border border-gray-200 sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Datum i Vreme
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Korisnik
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Vozilo
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Usluga
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Akcije
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($termini as $t)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($t->datum)->format('d.m.Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $t->vreme }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">{{ $t->user->name ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500">{{ $t->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">
                                            {{ $t->vozilo->marka_model ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500">{{ $t->vozilo->registracija ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700">{{ $t->usluga->naziv ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = match ($t->status) {
                                                'approved' => 'bg-primary-50 text-primary-700 border-primary-200',
                                                'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                                'done' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                default => 'bg-yellow-50 text-yellow-700 border-yellow-200', // pending
                                            };
                                            $statusLabel = match ($t->status) {
                                                'approved' => 'Potvrđen',
                                                'cancelled' => 'Otkazan',
                                                'done' => 'Završeno',
                                                default => 'Na čekanju',
                                            };
                                        @endphp
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-md border {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('admin.termini.edit', $t) }}"
                                                class="text-primary-600 hover:text-primary-900 font-semibold hover:underline">
                                                Izmeni
                                            </a>

                                            <form action="{{ route('admin.termini.destroy', $t) }}" method="POST"
                                                onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj termin?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-semibold hover:underline">
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
                        <div class="p-8 text-center text-gray-500">
                            Nema zakazanih termina.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
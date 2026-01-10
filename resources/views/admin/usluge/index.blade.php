<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Upravljanje Uslugama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('admin.usluge.create') }}"
                    class="px-5 py-2.5 bg-indigo-600 rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:bg-indigo-500 shadow-sm transition duration-150 ease-in-out">
                    Nova Usluga
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Naziv
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Cena
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Trajanje
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Opis
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
                            @foreach($usluge as $u)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base font-medium text-gray-900">{{ $u->naziv }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-700 font-medium">{{ number_format($u->cena, 2) }}
                                            RSD</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $u->trajanje_min }} min
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 max-w-xs truncate" title="{{ $u->opis }}">
                                            {{ $u->opis }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($u->featured)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                Izdvojeno
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('admin.usluge.edit', $u) }}"
                                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-md hover:bg-indigo-100 transition duration-150">
                                                Izmeni
                                            </a>
                                            <form action="{{ route('admin.usluge.destroy', $u) }}" method="POST"
                                                onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu uslugu?');">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
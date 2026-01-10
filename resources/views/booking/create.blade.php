<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zakaži Termin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 p-4 rounded-md bg-red-50 border border-red-200 text-red-700 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Usluga -->
                            <div>
                                <x-input-label for="usluga_id" :value="__('Usluga')" />
                                <select name="usluga_id" id="usluga_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($usluge as $u)
                                        <option value="{{ $u->id }}" {{ old('usluga_id', $selectedUslugaId) == $u->id ? 'selected' : '' }}>
                                            {{ $u->naziv }} - {{ number_format($u->cena, 0, ',', '.') }} RSD
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Datum -->
                            <div>
                                <x-input-label for="datum" :value="__('Datum')" />
                                <x-text-input id="datum" class="block mt-1 w-full" type="date" name="datum"
                                    :value="old('datum', $selectedDate)" required />
                                <p class="text-xs text-gray-500 mt-1">Promena datuma će osvežiti slobodne termine.</p>
                            </div>

                            <!-- Vreme -->
                            <div>
                                <x-input-label for="vreme" :value="__('Vreme')" />
                                <select name="vreme" id="vreme"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                    @forelse($availableSlots as $slot)
                                        <option value="{{ $slot }}" {{ old('vreme') == $slot ? 'selected' : '' }}>{{ $slot }}
                                        </option>
                                    @empty
                                        <option value="" disabled>Nema slobodnih termina za ovaj datum</option>
                                    @endforelse
                                </select>
                            </div>

                            <!-- Registracija -->
                            <div>
                                <x-input-label for="registracija" :value="__('Registracija Vozila')" />
                                <x-text-input id="registracija" class="block mt-1 w-full" type="text"
                                    name="registracija" :value="old('registracija')" placeholder="npr. BG-123-XY"
                                    required />
                            </div>

                            <!-- Marka i Model -->
                            <div>
                                <x-input-label for="marka_model" :value="__('Marka i Model')" />
                                <x-text-input id="marka_model" class="block mt-1 w-full" type="text" name="marka_model"
                                    :value="old('marka_model')" placeholder="npr. Audi A4" required />
                            </div>

                            <!-- Godina -->
                            <div>
                                <x-input-label for="godina" :value="__('Godina Proizvodnje')" />
                                <x-text-input id="godina" class="block mt-1 w-full" type="number" name="godina"
                                    :value="old('godina')" min="1950" max="{{ date('Y') + 1 }}" required />
                            </div>
                        </div>

                        <!-- Napomena -->
                        <div>
                            <x-input-label for="napomena" :value="__('Napomena (Opciono)')" />
                            <textarea id="napomena" name="napomena" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('napomena') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button class="ml-4 bg-red-600 hover:bg-red-500">
                                {{ __('Zakaži Termin') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('datum').addEventListener('change', function () {
            const date = this.value;
            if (date) {
                const url = new URL(window.location.href);
                url.searchParams.set('datum', date);
                window.location.href = url.toString();
            }
        });
    </script>
</x-app-layout>
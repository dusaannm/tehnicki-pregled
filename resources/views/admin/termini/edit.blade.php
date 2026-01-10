<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Izmeni Termin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.termini.update', $termin) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="datum" :value="__('Datum')" />
                                <x-text-input id="datum" class="block mt-1 w-full" type="date" name="datum"
                                    :value="old('datum', $selectedDate)" required />
                            </div>

                            <div>
                                <x-input-label for="vreme" :value="__('Vreme')" />
                                <select name="vreme" id="vreme"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                    @foreach($availableSlots as $slot)
                                        <option value="{{ $slot }}" {{ old('vreme', $termin->vreme) == $slot ? 'selected' : '' }}>
                                            {{ $slot }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="marka_model" :value="__('Marka i Model')" />
                                <x-text-input id="marka_model" class="block mt-1 w-full" type="text" name="marka_model"
                                    :value="old('marka_model', $termin->vozilo->marka_model ?? '')" required />
                            </div>

                            <div>
                                <x-input-label for="registracija" :value="__('Registracija')" />
                                <x-text-input id="registracija" class="block mt-1 w-full" type="text"
                                    name="registracija" :value="old('registracija', $termin->vozilo->registracija ?? '')" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="pending" {{ $termin->status == 'pending' ? 'selected' : '' }}>Na čekanju
                                </option>
                                <option value="approved" {{ $termin->status == 'approved' ? 'selected' : '' }}>Potvrđen
                                </option>
                                <option value="cancelled" {{ $termin->status == 'cancelled' ? 'selected' : '' }}>Otkazan
                                </option>
                                <option value="done" {{ $termin->status == 'done' ? 'selected' : '' }}>Završeno</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="napomena" :value="__('Napomena')" />
                            <textarea id="napomena" name="napomena" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('napomena', $termin->napomena) }}</textarea>
                        </div>

                        <!-- Hidden required fields to pass validation if not changed -->
                        <input type="hidden" name="user_id" value="{{ $termin->user_id }}">
                        <input type="hidden" name="usluga_id" value="{{ $termin->usluga_id }}">
                        <input type="hidden" name="vozilo_id" value="{{ $termin->vozilo_id }}">


                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Ažuriraj Status') }}
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
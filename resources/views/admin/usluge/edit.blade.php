<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Izmeni Uslugu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.usluge.update', $usluga) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="naziv" :value="__('Naziv')" />
                            <x-text-input id="naziv" class="block mt-1 w-full" type="text" name="naziv"
                                :value="old('naziv', $usluga->naziv)" required />
                            <x-input-error :messages="$errors->get('naziv')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="opis" :value="__('Opis')" />
                            <textarea id="opis" name="opis" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('opis', $usluga->opis) }}</textarea>
                            <x-input-error :messages="$errors->get('opis')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="cena" :value="__('Cena (RSD)')" />
                                <x-text-input id="cena" class="block mt-1 w-full" type="number" step="0.01" name="cena"
                                    :value="old('cena', $usluga->cena)" required />
                                <x-input-error :messages="$errors->get('cena')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="trajanje_min" :value="__('Trajanje (min)')" />
                                <x-text-input id="trajanje_min" class="block mt-1 w-full" type="number"
                                    name="trajanje_min" :value="old('trajanje_min', $usluga->trajanje_min)" required />
                                <x-input-error :messages="$errors->get('trajanje_min')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="featured" type="checkbox" name="featured" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('featured', $usluga->featured) ? 'checked' : '' }}>
                            <label for="featured"
                                class="ml-2 text-sm text-gray-600">{{ __('Izdvojeno na početnoj') }}</label>
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Ažuriraj') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
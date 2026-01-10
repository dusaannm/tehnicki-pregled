<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Izmeni Vozilo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.vozila.update', $vozilo) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="marka_model" :value="__('Marka i Model')" />
                            <x-text-input id="marka_model" class="block mt-1 w-full" type="text" name="marka_model"
                                :value="old('marka_model', $vozilo->marka_model)" required />
                        </div>

                        <div>
                            <x-input-label for="registracija" :value="__('Registracija')" />
                            <x-text-input id="registracija" class="block mt-1 w-full" type="text" name="registracija"
                                :value="old('registracija', $vozilo->registracija)" required />
                        </div>

                        <div>
                            <x-input-label for="godina" :value="__('Godina')" />
                            <x-text-input id="godina" class="block mt-1 w-full" type="number" name="godina"
                                :value="old('godina', $vozilo->godina)" required />
                        </div>

                        <!-- Hidden user_id -->
                        <input type="hidden" name="user_id" value="{{ $vozilo->user_id }}">


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
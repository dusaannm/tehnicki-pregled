<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo vozilo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.vozila.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label>Marka i Model <input type="text" name="marka_model" /></label>
                        </div>
                        <div class="mb-4">
                            <label>Registracija <input type="text" name="registracija" /></label>
                        </div>
                        <button type="submit">Sačuvaj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
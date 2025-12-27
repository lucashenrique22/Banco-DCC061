<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Investimento') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.investments.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">
                            Nome
                        </label>
                        <input
                            type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 font-medium mb-2">
                            Tipo
                        </label>
                        <input
                            type="text"
                            id="type"
                            name="type"
                            value="{{ old('type') }}"
                            class="w-full border rounded px-3 py-2 @error('type') border-red-500 @enderror"
                            required>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="term_months" class="block text-gray-700 font-medium mb-2">
                            Prazo (meses)
                        </label>
                        <input
                            type="number"
                            id="term_months"
                            name="term_months"
                            value="{{ old('term_months') }}"
                            class="w-full border rounded px-3 py-2 @error('term_months') border-red-500 @enderror"
                            required>
                        @error('term_months')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="minimum_value" class="block text-gray-700 font-medium mb-2">
                            Valor Mínimo
                        </label>
                        <input
                            type="number"
                            id="minimum_value"
                            name="minimum_value"
                            step="0.01"
                            value="{{ old('minimum_value') }}"
                            class="w-full border rounded px-3 py-2 @error('minimum_value') border-red-500 @enderror"
                            required>
                        @error('minimum_value')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="profitability" class="block text-gray-700 font-medium mb-2">
                            Taxa (%)
                        </label>
                        <input
                            type="number"
                            id="profitability"
                            name="profitability"
                            step="0.01"
                            value="{{ old('profitability') }}"
                            class="w-full border rounded px-3 py-2 @error('profitability') border-red-500 @enderror"
                            required>
                        @error('profitability')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Salvar
                        </button>
                        <a
                            href="{{ route('admin.investments.index') }}"
                            class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
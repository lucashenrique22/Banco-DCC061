<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Investimento') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.investments.update', $investment) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nome
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $investment->name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="rate" class="block text-sm font-medium text-gray-700 mb-1">
                            Taxa (%)
                        </label>
                        <input
                            type="number"
                            id="rate"
                            name="rate"
                            value="{{ old('rate', $investment->rate) }}"
                            step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('rate') border-red-500 @enderror"
                            required>
                        @error('rate')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="term" class="block text-sm font-medium text-gray-700 mb-1">
                            Prazo (meses)
                        </label>
                        <input
                            type="number"
                            id="term"
                            name="term"
                            value="{{ old('term', $investment->term) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('term') border-red-500 @enderror"
                            required>
                        @error('term')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
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
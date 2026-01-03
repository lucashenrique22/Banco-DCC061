<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Editar Investimento') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.investments.update', $investment) }}">
                    @csrf
                    @method('PUT')

                    <x-input-label value="Nome" />
                    <x-text-input id="name" name="name" :value="old('name', $investment->name)" class="w-full mb-4" required />

                    <x-input-label value="Tipo" />
                    <x-text-input id="type" name="type" :value="old('type', $investment->type)" class="w-full mb-4" required />

                    <x-input-label value="Prazo (meses)" />
                    <x-text-input id="term_months" name="term_months" type="number" :value="old('term_months', $investment->term_months)" class="w-full mb-4" required />

                    <x-input-label value="Valor Mínimo" />
                    <x-text-input id="minimum_value" name="minimum_value" type="number" step="0.01" :value="old('minimum_value', $investment->minimum_value)" class="w-full mb-6" required />

                    <x-input-label value="Taxa (%)" />
                    <x-text-input id="profitability" name="profitability" type="number" step="0.01" :value="old('profitability', $investment->profitability)" class="w-full mb-4" required />
                    <div class="flex gap-4">
                        <x-primary-button>Salvar</x-primary-button>
                        <x-danger-button href="{{ route('admin.investments.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Cancelar
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
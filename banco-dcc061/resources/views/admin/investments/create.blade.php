<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Novo Investimento') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.investments.store') }}">
                    @csrf

                    <x-input-label value="Nome" />
                    <x-text-input id="name" name="name" class="w-full mb-4" required />

                    <x-input-label value="Tipo" />
                    <x-text-input id="type" name="type" class="w-full mb-4" required />

                    <x-input-label value="Prazo (meses)" />
                    <x-text-input id="term_months" name="term_months" type="number" class="w-full mb-4" required />

                    <x-input-label value="Valor Mínimo" />
                    <x-text-input id="minimum_value" name="minimum_value" type="number" step="0.01" class="w-full mb-4" required />

                    <x-input-label value="Taxa (%)" />
                    <x-text-input id="profitability" name="profitability" type="number" step="0.01" class="w-full mb-4" required />

                    <div class="flex gap-3">
                        <x-primary-button>Salvar</x-primary-button>
                        <x-danger-button href="{{ route('admin.investments.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Cancelar</x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
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
                    @method('POST')
                    <x-input-label value="Nome" />
                    <x-input-error :messages="$errors->get('name')" />
                    <x-text-input id="name" name="name" class="w-full mb-4" />

                    <x-input-label value="Tipo" />
                    <x-input-error :messages="$errors->get('type')" />
                    <x-text-input id="type" name="type" class="w-full mb-4" />

                    <x-input-label value="Prazo (meses)" />
                    <x-input-error :messages="$errors->get('term_months')" />
                    <x-text-input id="term_months" name="term_months" type="number" class="w-full mb-4" />

                    <x-input-label value="Valor Mínimo" />
                    <x-input-error :messages="$errors->get('minimum_value')" />
                    <x-text-input id="minimum_value" name="minimum_value" type="number" step="0.01" class="w-full mb-4" />

                    <x-input-label value="Taxa (%)" />
                    <x-input-error :messages="$errors->get('profitability')" />
                    <x-text-input id="profitability" name="profitability" type="number" step="0.01" class="w-full mb-4" />

                    <div class="flex gap-3">
                        <x-primary-button>Salvar</x-primary-button>
                        <a href="{{ route('admin.investments.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700
                     focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
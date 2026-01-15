<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Depósito') }}
        </h2>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('transaction.deposit') }}">
                    @csrf
                    <div>
                        <x-input-label value="Conta de Destino" />
                        <x-text-input
                            type="text"
                            class="block w-full mt-1 bg-gray-200"
                            value="{{ auth()->user()->account->account_number }}"
                            disabled />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="amount" value="Valor do Depósito" />
                        <x-text-input id="amount" name="amount" type="number" step="0.01" min="1" class="block w-full mt-1" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="mt-4 flex justify-end gap-3">
                        <x-primary-button>
                            Confirmar Depósito
                        </x-primary-button>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700
                     focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transferência') }}
        </h2>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('transaction.transfer') }}">
                    @csrf

                    <div>
                        <x-input-label for="destination_account" value="Conta de Destino" />
                        <x-text-input
                            id="destination_account"
                            name="destination_account"
                            type="text"
                            class="block w-full mt-1"
                            required />
                        <x-input-error :messages="$errors->get('destination_account')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="amount" value="Valor da Transferência" />
                        <x-text-input
                            id="amount"
                            name="amount"
                            type="number"
                            step="0.01"
                            min="1"
                            class="block w-full mt-1"
                            required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>
                            Confirmar Transferência
                        </x-primary-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
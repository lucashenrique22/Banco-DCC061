<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitar Crédito') }}
        </h2>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('credit.request') }}">
                    @csrf

                    <div>
                        <x-input-label for="amount" value="Valor solicitado" />
                        <x-text-input
                            id="amount"
                            name="amount"
                            type="number"
                            step="0.01"
                            min="100"
                            class="block w-full mt-1"
                            required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>
                            Solicitar Crédito
                        </x-primary-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
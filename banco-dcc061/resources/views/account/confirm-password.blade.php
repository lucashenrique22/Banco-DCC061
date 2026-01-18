<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consultar Saldo e Extrato') }}
        </h2>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('account.statement') }}">
                    @csrf

                    <x-input-label for="password" value="Confirme sua senha para acessar o extrato" />
                    <x-text-input id="password" name="password" type="password" class="block w-full mt-1" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <div class="mt-4 flex justify-end gap-3">
                        <x-primary-button>
                            Acessar
                        </x-primary-button>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-700
                     focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Voltar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
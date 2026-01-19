<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comprovante de Depósito') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-xl mx-auto bg-white shadow rounded p-6">

            <div class="mb-4 text-green-600 font-semibold">
                Depósito realizado com sucesso!
            </div>

            <p><strong>Conta:</strong> {{ $transaction->account->account_number }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($transaction->amount, 2, ',', '.') }}</p>
            <p><strong>Data:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Código da operação:</strong> #{{ $transaction->id }}</p>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('account.statement') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Voltar ao extrato
                </a>

                <button onclick="window.print()"
                    class="px-4 py-2 bg-gray-800 text-white rounded">
                    Imprimir
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comprovante de Transferência') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-xl mx-auto bg-white shadow rounded p-6">

            <div class="mb-4 text-green-600 font-semibold">
                Transferência realizada com sucesso!
            </div>

            <div class="space-y-2 text-sm">
                <p><strong>Data:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Conta de Origem:</strong> {{ $transaction->account->account_number }}</p>
                <p><strong>Conta de Destino:</strong> {{ $transaction->destination_account }}</p>
                <p><strong>Valor:</strong> R$ {{ number_format($transaction->amount, 2, ',', '.') }}</p>
                <p><strong>Tipo:</strong> Transferência</p>
                <!-- <p><strong>Código da Operação:</strong> #{{ $transaction->id }}</p> -->
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('account.statement') }}"
                    class="text-blue-600 hover:underline">
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
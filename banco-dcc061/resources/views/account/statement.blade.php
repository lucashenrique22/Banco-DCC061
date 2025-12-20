<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Saldo e Extrato') }}
        </h2>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- @if (session('sucess'))
                <div class="p-4 font-bold text-sm text-center text-green-500">
                    {{ session('sucess') }}
                </div>
            @endif -->
            <!-- SALDO -->
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">Saldo Atual</h3>
                <p class="text-2xl font-bold text-green-600">
                    R$ {{ number_format($account->balance, 2, ',', '.') }}
                </p>
            </div>

            <!-- EXTRATO -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Extrato</h3>

                @if($transactions->isEmpty())
                <p class="text-gray-600">Nenhuma movimentação encontrada.</p>
                @else
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-center py-2">Data</th>
                            <th class="text-center py-2">Tipo</th>
                            <th class="text-center py-2">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr class="border-b">
                            <td class="py-2 text-center">
                                {{ $transaction->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-2 text-center">
                                {{ ucfirst($transaction->type) }}
                            </td>
                            <td class="py-2 text-center">
                                R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

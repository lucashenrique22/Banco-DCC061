<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Investimentos Disponíveis
        </h2>
    </x-slot>

    <div class="pt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="border-b">
                        <th class="text-center w-1/4">Nome</th>
                        <th class="text-center w-1/4">Tipo</th>
                        <th class="text-center w-1/4">Rentabilidade</th>
                        <th class="text-center w-1/4">Mínimo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investments as $investment)
                    <tr class="border-b">
                        <td class="text-center">{{ $investment->name }}</td>
                        <td class="text-center">{{ $investment->type }}</td>
                        <td class="text-center">{{ $investment->profitability }}%</td>
                        <td class="text-center">
                            R$ {{ number_format($investment->minimum_value, 2, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
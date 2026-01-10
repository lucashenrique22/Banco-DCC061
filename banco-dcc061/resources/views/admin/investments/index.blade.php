<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Investimentos') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 font-medium text-sm text-center text-green-600">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.querySelector('[data-success]');
                    if (alert) alert.remove();
                }, 4000);
            </script>
            @endif

            <div class="bg-white p-6 rounded shadow">
                <a href="{{ route('admin.investments.create') }}"
                    class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">
                    Novo Investimento
                </a>

                @if($investments->isEmpty())
                <p class="text-gray-600">Nenhum investimento cadastrado.</p>
                @else
                <table class="w-full table-fixed border-collapse">
                    <thead>
                            <tr class="border-b">
                                <th class="text-center py-2">Nome</th>
                                <th class="text-center py-2">Taxa (%)</th>
                                <th class="text-center py-2">Prazo (meses)</th>
                                <th class="text-center py-2">Valor mínimo</th>
                                <th class="text-center py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($investments as $investment)
                            <tr class="border-b">
                                <td class="py-2 text-center">
                                    {{ $investment->name }}
                                </td>
                                <td class="py-2 text-center">
                                    {{ number_format($investment->profitability, 2, ',', '.') }}%
                                </td>
                                <td class="py-2 text-center">
                                    {{ $investment->term_months }}
                                </td>
                                <td class="py-2 text-center">
                                    R$ {{ number_format($investment->minimum_value, 2, ',', '.') }}
                                </td>
                                <td class="py-2 text-center flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.investments.edit', $investment) }}" class="text-blue-600">
                                        ✏️
                                    </a>
                                    <form method="POST"
                                        action="{{ route('admin.investments.destroy', $investment) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600"
                                            onclick="return confirm('Deseja remover este investimento?')">
                                            🗑️
                                        </button>
                                    </form>
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
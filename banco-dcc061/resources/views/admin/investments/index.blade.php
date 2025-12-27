<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Investimentos') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div
                data-success
                class="mb-6 rounded border border-green-300 bg-green-50 px-4 py-3 text-green-800 font-medium">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.querySelector('[data-success]');
                    if (alert) alert.remove();
                }, 4000);
            </script>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <a
                        href="{{ route('admin.investments.create') }}"
                        class="mb-4 inline-block px-4 mt-4 py-2 bg-blue-600 text-white rounded">
                        Novo Investimento
                    </a>
                </div>

                @if($investments->isEmpty())
                <p class="text-gray-600">Nenhum investimento cadastrado.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="text-center w-1/4 py-2">Nome</th>
                                <th class="text-center w-1/4 py-2">Taxa (%)</th>
                                <th class="text-center w-1/4 py-2">Prazo (meses)</th>
                                <th class="text-center w-1/4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($investments as $investment)
                            <tr class="border-b">
                                <td class="py-2 text-center">
                                    {{ $investment->name }}
                                </td>
                                <td class="py-2 text-center">
                                    {{ number_format($investment->rate, 2, ',', '.') }}%
                                </td>
                                <td class="py-2 text-center">
                                    {{ $investment->term }}
                                </td>
                                <td class="py-2 text-center">
                                    <a
                                        href="{{ route('admin.investments.edit', $investment) }}"
                                        class="text-indigo-600 hover:underline">
                                        Editar
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.investments.destroy', $investment) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:underline ml-2"
                                            onclick="return confirm('Deseja remover este investimento?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
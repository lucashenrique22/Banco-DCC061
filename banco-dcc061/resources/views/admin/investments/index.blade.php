<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Investimentos') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 font-medium text-sm text-center text-green-600" data-success>
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
                    class="mb-4 inline-block px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded">
                    Cadastrar Investimento
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
                            <td class="py-2 text-center">
                                <div class="flex justify-center items-center gap-4">
                                    <a href="{{ route('admin.investments.edit', $investment) }}" class="text-gray-800 hover:text-gray-700 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="text-gray-800 hover:text-gray-700 transition" x-data x-on:click="$dispatch('open-delete-modal', {id: {{ $investment->id }},name: '{{ $investment->name }}'
                                    })">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
        </div>
    </div>

    <div
        x-data="{
            open: false,
            investmentId: null,
            investmentName: ''
        }"
        x-on:open-delete-modal.window="
            open = true;
            investmentId = $event.detail.id;
            investmentName = $event.detail.name;
        "
        x-on:close-delete-modal.window="
            open = false;
            investmentId = null;
            investmentName = '';
        "
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div class="bg-white rounded-xl shadow-xl max-w-lg mx-4 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Confirmar exclusão
            </h2>
            <p class="mb-6">Tem certeza que deseja excluir o investimento "<span
                    class="font-bold" x-text="investmentName"></span>"?</p>
            <div class="flex justify-end gap-4">
                <button
                    type="button"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded"
                    x-on:click="$dispatch('close-delete-modal')">
                    Cancelar
                </button>
                <form :action="`/admin/investments/${investmentId}`" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <p>Bem-vindo, <strong>{{ auth()->user()->name }}</strong></p>
        <p class="text-sm text-gray-600">
            Perfil: {{ ucfirst(auth()->user()->role) }}
        </p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- MENU CLIENTE -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Saldo / Extrato -->
                <a href="{{ route('account.statement') }}"
                    class="block bg-blue-100 hover:bg-blue-200 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Saldo e Extrato</h3>
                    <p class="text-sm text-gray-700">
                        Consulte seu saldo e histórico de transações
                    </p>
                </a>

                <!-- Depósito -->
                <a href="{{ route('transaction.deposit') }}"
                    class="block bg-green-100 hover:bg-green-200 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Depósito</h3>
                    <p class="text-sm text-gray-700">
                        Realize depósitos na sua conta
                    </p>
                </a>

                <!-- Transferência -->
                <a href="{{ route('transaction.transfer') }}"
                    class="block bg-yellow-100 hover:bg-yellow-200 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Transferência</h3>
                    <p class="text-sm text-gray-700">
                        Envie dinheiro para outra conta
                    </p>
                </a>

                <!-- Solicitar Crédito -->
                <a href="{{ route('credit.request') }}"
                    class="block bg-purple-100 hover:bg-purple-200 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Solicitar Crédito</h3>
                    <p class="text-sm text-gray-700">
                        Faça uma solicitação de crédito
                    </p>
                </a>

                <!-- Investimentos (visualização) -->
                <a href="{{ route('investments.index') }}"
                    class="block bg-indigo-100 hover:bg-indigo-200 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Investimentos</h3>
                    <p class="text-sm text-gray-700">
                        Veja opções de investimento disponíveis
                    </p>
                </a>

            </div>

            <!-- MENU ADMINISTRADOR -->
            @if(auth()->user()->isAdmin())
            <div class="mt-10">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">
                    Área Administrativa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Gerenciar Usuários -->
                    <a href="{{ route('admin.users.index') }}"
                        class="block bg-red-100 hover:bg-red-200 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Usuários</h3>
                        <p class="text-sm text-gray-700">
                            Cadastrar, editar e remover usuários
                        </p>
                    </a>

                    <!-- Analisar Créditos -->
                    <a href="{{ route('admin.credits.index') }}"
                        class="block bg-orange-100 hover:bg-orange-200 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Créditos</h3>
                        <p class="text-sm text-gray-700">
                            Avaliar solicitações de crédito
                        </p>
                    </a>

                    <!-- Gerenciar Investimentos -->
                    <a href="{{ route('admin.investments.index') }}"
                        class="block bg-gray-200 hover:bg-gray-300 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Investimentos</h3>
                        <p class="text-sm text-gray-700">
                            Gerenciar produtos de investimento
                        </p>
                    </a>

                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
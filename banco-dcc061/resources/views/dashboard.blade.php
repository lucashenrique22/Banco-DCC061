<x-app-layout>
    <x-slot name="header">
        <p>Bem-vindo, <strong>{{ auth()->user()->name }}</strong></p>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- MENU ADMINISTRADOR -->
            @if(auth()->user()->isAdmin())
                <div class="mt-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                        <!-- Gerenciar Usuários -->
                        <a href="{{ route('admin.users.index') }}"
                            class="block p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">Usuários</h3>
                            <p class="text-sm text-gray-700">
                                Cadastrar, editar e remover usuários
                            </p>
                        </a>

                        <!-- Analisar Créditos -->
                        <a href="{{ route('admin.credits.index') }}"
                            class="block p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">Créditos</h3>
                            <p class="text-sm text-gray-700">
                                Avaliar solicitações de crédito
                            </p>
                        </a>

                        <!-- Gerenciar Investimentos -->
                        <a href="{{ route('admin.investments.index') }}"
                            class="block p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">Investimentos</h3>
                            <p class="text-sm text-gray-700">
                                Gerenciar produtos de investimento
                            </p>
                        </a>

                    </div>
                </div>
            @else
                <!-- MENU CLIENTE -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Saldo / Extrato -->
                    <a href="{{ route('account.statement') }}"
                        class="block p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Saldo e Extrato</h3>
                        <p class="text-sm text-gray-700">
                            Consulte seu saldo e histórico de transações
                        </p>
                    </a>

                    <!-- Depósito -->
                    <a href="{{ route('transaction.deposit') }}"
                        class="block p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Depósito</h3>
                        <p class="text-sm text-gray-700">
                            Realize depósitos na sua conta
                        </p>
                    </a>

                    <!-- Transferência -->
                    <a href="{{ route('transaction.transfer') }}"
                        class="block p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Transferência</h3>
                        <p class="text-sm text-gray-700">
                            Envie dinheiro para outra conta
                        </p>
                    </a>

                    <!-- Solicitar Crédito -->
                    <a href="{{ route('credit.request') }}"
                        class="block p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Solicitar Crédito</h3>
                        <p class="text-sm text-gray-700">
                            Faça uma solicitação de crédito
                        </p>
                    </a>

                    <!-- Investimentos (visualização) -->
                    <a href="{{ route('investments.index') }}"
                        class="block p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Investimentos</h3>
                        <p class="text-sm text-gray-700">
                            Veja opções de investimento disponíveis
                        </p>
                    </a>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>
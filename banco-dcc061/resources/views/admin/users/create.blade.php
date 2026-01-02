<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <x-input-label value="Nome" />
                    <x-text-input id="name" name="name" class="w-full mb-4" required />

                    <x-input-label value="CPF" />
                    <x-text-input id="cpf" name="cpf" class="w-full mb-4" required />

                    <x-input-label value="Senha" />
                    <x-text-input id="password" name="password" type="password" class="w-full mb-4" required />

                    <x-input-label value="Perfil" />
                    <select name="role" class="w-full mb-4 rounded border-gray-300">
                        <option value="usuario">Usuário</option>
                        <option value="administrador">Administrador</option>
                    </select>

                    <x-primary-button>Salvar</x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://unpkg.com/imask"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const element = document.getElementById('cpf');
        const maskOptions = {
            mask: '000.000.000-00'
        };
        const mask = IMask(element, maskOptions);
    });
</script>
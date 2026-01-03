<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <x-input-label value="Nome" />
                    <x-text-input name="name" value="{{ $user->name }}" class="w-full mb-4" required />

                    <x-input-label value="CPF" />
                    <x-text-input id="cpf" name="cpf" value="{{ $user->cpf }}" class="w-full mb-4" required />

                    <x-input-label value="Nova senha (opcional)" />
                    <x-text-input name="password" type="password" class="w-full mb-4" />

                    <x-input-label value="Perfil" />
                    <select name="role" class="w-full mb-4 rounded border-gray-300">
                        <option value="administrador" @selected($user->role === 'administrador')>Administrador</option>
                        <option value="usuario" @selected($user->role === 'usuario')>Usuário</option>
                    </select>

                    <x-primary-button>Salvar</x-primary-button>
                    <x-danger-button href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Cancelar</x-danger-button>
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
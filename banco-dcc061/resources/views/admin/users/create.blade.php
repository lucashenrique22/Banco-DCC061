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
                    <x-input-error :messages="$errors->get('name')" />
                    <x-text-input id="name" name="name" class="w-full mb-4" value="{{ old('name') }}" />

                    <x-input-label value="CPF" />
                    <x-input-error :messages="$errors->get('cpf')" />
                    <x-text-input id="cpf" name="cpf" class="w-full mb-4" value="{{ old('cpf') }}" />

                    <x-input-label value="Senha" />
                    <x-input-error :messages="$errors->get('password')" />
                    <x-text-input id="password" name="password" type="password" class="w-full mb-4" />

                    <x-input-label value="Perfil" />
                    <select name="role" class="w-full mb-4 rounded border-gray-300">
                        <option value="usuario" @selected(old('role')=='usuario' )>Usuário</option>
                        <option value="administrador" @selected(old('role')=='administrador' )>Administrador</option>
                    </select>

                    <div class="flex justify-end gap-2">
                        <x-primary-button>Salvar</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-700
                     focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                    </div>
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Gestão de Usuários') }}
        </h2>
    </x-slot>

    <div class="pt-4 max-w-7xl mx-auto">
        @if (session('success'))
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

        <x-input-error :messages="session('error')" class="mb-4 text-center" data-error />

        <div class="bg-white p-6 rounded shadow">
            <a href="{{ route('admin.users.create') }}"
                class="mb-4 inline-block px-4 mt-4 py-2 bg-blue-600 text-white rounded">
                Novo Usuário
            </a>
            <table class="w-full table-fixed border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-center py-2">Nome</th>
                        <th class="text-center py-2">CPF</th>
                        <th class="text-center py-2">Perfil</th>
                        <th class="text-center py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b">
                        <td class="text-center py-2">{{ $user->name }}</td>
                        <td class="text-center py-2">{{ preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $user->cpf) }}</td>
                        <td class="text-center py-2">{{ ucfirst($user->role) }}</td>
                        <td class="text-center py-2 flex justify-center items-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 mr-3">
                                ✏️
                            </a>
                            <button
                                type="button"
                                class="text-red-600"
                                x-data
                                x-on:click="$dispatch('open-delete-modal', {
                                        id: {{ $user->id }},
                                        name: '{{ $user->name }}'
                                    })">
                                🗑️
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div
        x-data="{
            open: false,
            userId: null,
            userName: ''
        }"
        x-on:open-delete-modal.window="open = true; userId = $event.detail.id; userName = $event.detail.name;
    "
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div class="bg-white rounded-xl shadow-xl max-w-lg mx-4 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Confirmar exclusão
            </h2>

            <p class="text-gray-600 mb-6">
                Tem certeza que deseja excluir o usuário
                <strong x-text="userName"></strong>?
                <br>
                <span class="text-red-600 font-semibold">
                    Essa ação não pode ser desfeita.
                </span>
            </p>

            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                    x-on:click="open = false">
                    Cancelar
                </button>

                <form
                    method="POST"
                    x-bind:action="`/admin/users/${userId}`">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorAlert = document.querySelector('[data-error]');
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.remove();
            }, 4000);
        }
    });
</script>
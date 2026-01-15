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
                            <form method="POST"
                                action="{{ route('admin.users.destroy', $user) }}"
                                onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
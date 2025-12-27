<x-app-layout>
    <x-slot name="header">
        Gestão de Usuários
    </x-slot>

    <div class="pt-4 max-w-7xl mx-auto">
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
                        <td class="text-center py-2">{{ $user->cpf }}</td>
                        <td class="text-center py-2">{{ $user->role }}</td>
                        <td class="text-center py-2">
                            <form method="POST"
                                action="{{ route('admin.users.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">
                                    Excluir
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
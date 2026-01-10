<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Gestão de Usuários') }}
        </h2>
    </x-slot>

    <div class="pt-4 max-w-7xl mx-auto">
        @if (session('success'))
        <div class="mb-4 font-medium text-sm text-center text-green-600">
            {{ session('success') }}
        </div>
        @endif
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
                                action="{{ route('admin.users.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">
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
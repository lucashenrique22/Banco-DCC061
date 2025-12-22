<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitações de Crédito') }}
        </h2>
    </x-slot>

    <div class="py-8 pt-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 font-medium text-sm text-center text-green-600">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if($requests->isEmpty())
                <p class="text-black-600">Nenhuma solicitação encontrada.</p>
                @else
                @foreach($requests as $credit)
                <div class="border rounded p-4 mb-4">
                    <p><strong>Usuário:</strong> {{ $credit->user->name }}</p>
                    <p><strong>Valor:</strong> R$ {{ number_format($credit->amount, 2, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $credit->status }}</p>

                    <form method="POST" action="{{ route('admin.credits.update', $credit->id) }}">
                        @csrf
                        @method('POST')

                        <div class="mt-4">
                            <x-input-label for="analysis_notes" />
                            <textarea
                                id="analysis_notes"
                                name="analysis_notes"
                                class="block w-full mt-1 rounded border-gray-300"
                                placeholder="Observações da análise (opcional)">{{ old('analysis_notes') }}</textarea>
                            <x-input-error :messages="$errors->get('analysis_notes')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex justify-center gap-2">
                            <x-primary-button type="submit" name="status" value="approved">Aprovar</x-primary-button>
                            <x-danger-button type="submit" name="status" value="rejected">Rejeitar</x-danger-button>
                        </div>
                    </form>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>

</x-app-layout>
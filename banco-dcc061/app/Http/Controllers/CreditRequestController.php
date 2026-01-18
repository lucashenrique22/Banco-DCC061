<?php

namespace App\Http\Controllers;

use App\Models\CreditRequest;
use Illuminate\Http\Request;

class CreditRequestController extends Controller
{
    public function create()
    {
        return view('credit_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate(['amount' => ['required', 'numeric', 'min:100'],], [
            'amount.required' => 'O valor solicitado é obrigatório.',
            'amount.numeric' => 'O valor solicitado deve ser numérico.',
            'amount.min' => 'O valor solicitado deve ser pelo menos 100.',
        ]);

        CreditRequest::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'status' => 'pendente',
        ]);

        return redirect()->route('dashboard')->with('success', 'Solicitação de crédito enviada com sucesso!');
    }
}

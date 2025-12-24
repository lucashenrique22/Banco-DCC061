<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display the account statement view.
     */
    public function statement()
    {
        $user = auth()->user();

        // Conta do usuário (assumindo 1 conta por usuário)
        $account = $user->account()->first();
        
        if (!$account) {
            abort(404, 'Conta não encontrada');
        }

        // Transações ordenadas por data
        $transactions = $account->transactions()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.statement', compact('account', 'transactions'));
    }
}

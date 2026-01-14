<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display the account statement view.
     */

    public function confirmPassword()
    {
        return view('account.confirm-password');
    }

    public function statement(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Senha incorreta'])->withInput();
        }

        // Conta do usuário (assumindo 1 conta por usuário)
        $account = $user->account()->firstOrFail();
        
        if (!$account) {
            abort(404, 'Conta não encontrada');
        }

        // Transações ordenadas por data
        $transactions = $account->transactions()->orderBy('created_at', 'desc')->get();

        return view('account.statement', compact('account', 'transactions'));
    }
}

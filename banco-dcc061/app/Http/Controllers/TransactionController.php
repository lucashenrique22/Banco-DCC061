<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use Exception;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function depositForm()
    {
        return view('transactions.deposit');
    }

    public function deposit(Request $request)
    {
        $request->validate(['amount' => ['required', 'numeric', 'min:1']]);

        try {
            $account = auth()->user()->account()->firstOrFail();

            $this->transactionService->deposit($account, (float) $request->amount);

            return redirect()->route('account.statement')->with('success', 'Depósito realizado com sucesso!');
        } catch (Exception $e) {
            return back()->withErrors(['amount' => $e->getMessage()])->withInput();
        }
    }

    public function transferForm()
    {
        return view('transactions.transfer');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'destination_account' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:1'],
            'password' => ['required', 'string'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Senha incorreta'])->withInput();
        }

        try {
            
            $fromAccount = $user->account()->firstOrFail();

            // Conta destino (exemplo simples: pelo ID ou número)
            $destination = Account::where('account_number', $request->destination_account)->firstOrFail();

            if (!$destination) {
                throw new Exception('Conta de destino não encontrada');
            }

            $this->transactionService->transfer($fromAccount, $destination, (float) $request->amount);

            return redirect()->route('account.statement')->with('success', 'Transferência realizada com sucesso!');
        } catch (Exception $e) {
            return back()->withErrors(['amount' => $e->getMessage()])->withInput();
        }
    }
}

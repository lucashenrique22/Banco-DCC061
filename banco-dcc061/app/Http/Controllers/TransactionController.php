<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use Exception;

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
            $account = auth()->user()->accounts()->firstOrFail();

            $this->transactionService->deposit($account, (float) $request->amount);

            return redirect()->route('account.statement')->with('success', 'Depósito realizado com sucesso!');
        } catch (Exception $e) {
            return back()->withErrors(['amount' => $e->getMessage()])->withInput();
        }
    }
}

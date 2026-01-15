<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class CreditAnalysisController extends Controller
{
    public function index()
    {
        $requests = CreditRequest::where('status', 'pendente')->with('user')->get();
        return view('admin.credits.index', compact('requests'));
    }

    public function update(Request $request, CreditRequest $creditRequest, TransactionService $transactionService)
    {
        $request->validate([
            'status' => ['required', 'in:aprovado,rejeitado'],
            'analysis_notes' => ['nullable', 'string'],
        ]);

        if ($creditRequest->status !== 'pendente') {
            return back()->withErrors([
                'status' => 'Esta solicitação já foi avaliada.'
            ]);
        }

        if ($request->status === 'aprovado') {
            $account = $creditRequest->user->account;

            if (!$account) {
                return back()->withErrors([
                    'status' => 'Conta do cliente não encontrada.'
                ]);
            }

            $transactionService->deposit($account, $creditRequest->amount);
        }

        $creditRequest->update([
            'status' => $request->status,
            'analysis_notes' => $request->analysis_notes,
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('admin.credits.index')->with('success', 'Análise de crédito atualizada com sucesso!');
    }
}

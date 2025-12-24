<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditRequest;
use Illuminate\Http\Request;

class CreditAnalysisController extends Controller
{
    public function index()
    {
        $requests = CreditRequest::where('status', 'pendente')->with('user')->get();
        return view('admin.credits.index', compact('requests'));
    }

    public function update(Request $request, CreditRequest $creditRequest)
    {
        $request->validate([
            'status' => ['required', 'in:aprovado,rejeitado'],
            'analysis_notes' => ['nullable', 'string'],
        ]);

        $creditRequest->update([
            'status' => $request->status,
            'analysis_notes' => $request->analysis_notes,
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('admin.credits.index')->with('success', 'Análise de crédito atualizada com sucesso!');
    }
}

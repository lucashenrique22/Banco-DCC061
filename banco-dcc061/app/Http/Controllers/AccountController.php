<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function generatePdf()
    {
        $user = auth()->user();
        $account = $user->account()->firstOrFail();

        if (!$account) {
            abort(404, 'Conta não encontrada');
        }

        $transactions = $account->transactions()->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('account.statement-pdf', compact('account', 'transactions'));

        return $pdf->download('extrato-conta.pdf');
    }

    public function generateXml()
    {
        $user = auth()->user();
        $account = $user->account()->firstOrFail();

        if (!$account) {
            abort(404, 'Conta não encontrada');
        }

        $transactions = $account->transactions()->orderBy('created_at', 'desc')->get();

        $xml = new \SimpleXMLElement('<Extrato/>');
        $xml->addChild('Cliente', $user->name);
        $xml->addChild('Conta', $account->account_number);
        $xml->addChild('SaldoAtual', number_format($account->balance, 2, ',', '.'));
        $xml->addChild('DataEmissao', now()->format('d/m/Y H:i'));

        $transacoesXml = $xml->addChild('Transacoes');

        foreach ($transactions as $transaction) {
            $transacaoXml = $transacoesXml->addChild('Transacao');
            $transacaoXml->addChild('Tipo', ucfirst($transaction->type));
            $transacaoXml->addChild('Valor', number_format($transaction->amount, 2, ',', '.'));
            $transacaoXml->addChild('Data', $transaction->created_at->format('d/m/Y H:i'));
            if ($transaction->type === 'transfer') {
                $transacaoXml->addChild('ContaDestino', $transaction->destination_account);
            }
        }

        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="extrato-conta.xml"');
    }
}

<?php
namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionService
{
    public function transfer(Account $from, string $destination, float $amount)
    {
        if ($amount <= 0) {
            throw new Exception('Valor inválido');
        }

        if ($from->balance < $amount) {
            throw new Exception('Saldo insuficiente');
        }

        DB::transaction(function () use ($from, $destination, $amount) {
            $from->decrement('balance', $amount);

            Transaction::create([
                'account_id' => $from->id,
                'type' => 'transferencia',
                'amount' => $amount,
                'destination_account' => $destination,
            ]);
        });
    }

    public function deposit(Account $account, float $amount)
    {
        if ($amount <= 0) {
            throw new Exception('Valor inválido');
        }

        DB::transaction(function () use ($account, $amount) {
            $account->increment('balance', $amount);

            Transaction::create([
                'account_id' => $account->id,
                'type' => 'deposito',
                'amount' => $amount,
            ]);
        });
    }
}

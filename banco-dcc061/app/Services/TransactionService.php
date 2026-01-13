<?php
namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionService
{
    public function transfer(Account $from, Account $destination, float $amount)
    {
        if ($amount <= 0) {
            throw new Exception('Valor inválido');
        }

        if ($from->id === $destination->id) {
            throw new Exception('Conta de origem e destino não podem ser iguais');
        }

        if ($from->balance < $amount) {
            throw new Exception('Saldo insuficiente');
        }

       return DB::transaction(function () use ($from, $destination, $amount) {
            $from->decrement('balance', $amount);
            $destination->increment('balance', $amount);

            $saida = Transaction::create([
                'account_id' => $from->id,
                'type' => 'transferencia',
                'amount' => $amount,
                'destination_account' => $destination->account_number,
            ]);

            // Registro da entrada
            Transaction::create([
                'account_id' => $destination->id,
                'type' => 'transferencia',
                'amount' => $amount,
                'destination_account' => $from->account_number,
            ]);
            return $saida;
        });

    }

    public function deposit(Account $account, float $amount)
    {
        if ($amount <= 0) {
            throw new Exception('Valor inválido');
        }

        return DB::transaction(function () use ($account, $amount) {
            $account->increment('balance', $amount);

            return Transaction::create([
                'account_id' => $account->id,
                'type' => 'deposito',
                'amount' => $amount,
            ]);
        });
    }
}

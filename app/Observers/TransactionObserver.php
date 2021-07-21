<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        if ($transaction->id == 1) {
            if ($transaction->type == 1) {
                $transaction->net = $transaction->amount - $transaction->fees;
            } elseif ($transaction->type == 0) {
                $transaction->net = -$transaction->amount;
            }
        } else {
            $prevTransaction = Transaction::find($transaction->id - 1);
            if ($transaction->type == 1) {
                $transaction->net = $transaction->amount - $transaction->fees + $prevTransaction->net;
            } elseif ($transaction->type == 0) {
                $transaction->net = $prevTransaction->net - $transaction->amount;
            }
        }
        $transaction->save();
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}

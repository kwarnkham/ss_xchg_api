<?php

namespace App\Http\Controllers;

use App\Models\NetAmount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|numeric',
            'rate' => 'required|numeric',
            'name' => 'required'
        ]);

        if ($validated['type'] == 1) {
            $validated['fees'] = $validated['amount'] * $validated['rate'] / 100;
        } elseif ($validated['type'] == 0) {
            $validated['fees'] = 0;
        }
        
        $transaction = Transaction::create($validated);
        
        return response()->json($transaction, 201);
    }

    public function index()
    {
        $transactions = Transaction::orderBy('id','desc')->paginate(10);
        return response()->json($transactions, 200);
    }
}

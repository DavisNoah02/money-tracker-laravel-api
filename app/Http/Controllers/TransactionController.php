<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Add transaction
    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        $transaction = Transaction::create(
            $request->only('wallet_id', 'type', 'amount', 'description')
        );

        return response()->json($transaction, 201);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    // Create wallet
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
        ]);

        $wallet = Wallet::create(
            $request->only('user_id', 'name')
        );

        return response()->json($wallet, 201);
    }

    // View single wallet
    public function show($id)
    {
        $wallet = Wallet::with('transactions')->findOrFail($id);

        $balance = $wallet->transactions->sum(function ($transaction) {
            return $transaction->type === 'income'
                ? $transaction->amount
                : -$transaction->amount;
        });

        return response()->json([
            'id' => $wallet->id,
            'name' => $wallet->name,
            'balance' => $balance,
            'transactions' => $wallet->transactions,
        ]);
    }
}
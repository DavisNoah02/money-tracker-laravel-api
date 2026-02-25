<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Create user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
        ]);

        $user = User::create(
            $request->only('name', 'email')
        );

        return response()->json($user, 201);
    }

    // View user profile
    public function show($id)
    {
        $user = User::with('wallets.transactions')->findOrFail($id);

        $wallets = $user->wallets->map(function ($wallet) {

            $balance = $wallet->transactions->sum(function ($transaction) {
                return $transaction->type === 'income'
                    ? $transaction->amount
                    : -$transaction->amount;
            });

            return [
                'id' => $wallet->id,
                'name' => $wallet->name,
                'balance' => $balance,
            ];
        });

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'wallets' => $wallets,
            'total_balance' => $wallets->sum('balance'),
        ]);
    }
}
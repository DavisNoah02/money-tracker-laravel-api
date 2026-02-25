<?php

namespace App\Models;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;


/**
 * Transaction Model
 *
 * Represents a financial transaction (income or expense)
 * belonging to a specific wallet.
 */
class Transaction extends Model
{
    // Mass assignable attributes.
    protected $fillable = [
    'wallet_id',
    'type',
    'amount',
    'description'
];

// A transaction belongs to a single wallet.
    public function wallet()
{
    return $this->belongsTo(Wallet::class);
}
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

/**
 * Wallet Model
 *
 * Represents a financial account belonging to a user.
 * A wallet can contain multiple transactions.
 */
class Wallet extends Model
{
    //Mass assignable attributes.
    protected $fillable = [
    'user_id',
    'name'
];
// A wallet belongs to a single user.
    public function user()
{
    return $this->belongsTo(User::class);
}

// A wallet can have many transactions.
public function transactions()
{
    return $this->hasMany(Transaction::class);
}
}

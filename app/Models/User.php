<?php

namespace App\Models;


use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * User Model
 *
 * Represents a system user who can own multiple wallets.
 */
class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    //  mass assignable attribues
    
    protected $fillable = [
        'name',
        'email',
    ];

    // Attributes hidden from JSON responses.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute type casting
    protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
    ];
}

//  A user can have multiple wallets.
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
} 
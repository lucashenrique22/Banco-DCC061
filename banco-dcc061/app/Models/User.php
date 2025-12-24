<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'cpf',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function creditRequests()
    {
        return $this->hasMany(CreditRequest::class);
    }

    public function approvedCredits()
    {
        return $this->hasMany(CreditRequest::class, 'approved_by');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}

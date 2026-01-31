<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use  HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nis', // Nomor Induk Siswa
        'class', // Kelas
        'phone',
        'address',
        'wallet_balance',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'wallet_balance' => 'decimal:2',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isCustomer()
    {
        return $this->hasRole('customer');
    }

    public function isCashier()
    {
        return $this->hasRole('cashier');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
}
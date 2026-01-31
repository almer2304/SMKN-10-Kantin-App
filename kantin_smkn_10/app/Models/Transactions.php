<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code', 'order_id', 'amount',
        'payment_method', 'status', 'notes'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->transaction_code = 'TRX' . date('Ymd') . strtoupper(uniqid());
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'success' => 'success',
            'failed' => 'danger'
        ];

        return $badges[$this->status] ?? 'secondary';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'tenant_id',
        'amount'
    ];

    protected static function booted()
    {
        static::created(function ($transaksi) {
            $transaksi->code = 'TR' . $transaksi->id . now()->format('Ymd');
            $transaksi->save();
        });
    }
}
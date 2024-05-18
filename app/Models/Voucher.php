<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'customer_id', 'transaction_id','amount', 'redeemed', 'expired_at'];

    protected static function booted()
    {
        static::created(function ($voucher) {
            $voucher->code =  $voucher->id . now()->format('Ymd');
            $voucher->save();
        });
    }

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }
}
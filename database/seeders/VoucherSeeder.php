<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Voucher;


class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $transactions = Transaction::all();
        // $customer = Customer::all();
        
        // foreach ($transactions as $transaction) {
        Voucher::create([
            'code' => 'default',
            'customer_id' => 1,
            'transaction_id' => 1,
            'amount' => 10000,
            'expired_at' => Carbon::now()->addMonths(3),
            'redeemed' => false,
        ]);
    // }
    }
}
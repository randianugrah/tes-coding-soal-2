<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Voucher;
use App\Models\Customer;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $tenants = Tenant::all();
        $products = Product::all();
        return view('transaction', compact('customers' , 'tenants', 'products'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'code' => 'default',
            'customer_id' => 'required',
            'tenant_id' => 'required',
            'amount' => 'required',
        ]);

        $transaction = Transaction::create([
            'code' =>'default',
            'customer_id' =>  $request->customer_id,
            'tenant_id' =>  $request->tenant_id,
            'amount' =>  $request->amount,
        ]);

        if ($transaction->amount >= 1000000) {
            $totalVoucherAmount = intdiv($transaction->amount, 1000000) * 10000;
            $voucher = Voucher::create([
                'code' =>'default',
                'customer_id' => $transaction->customer_id,
                'transaction_id' => $transaction->id,
                'amount' =>  $totalVoucherAmount,
                'redeemed' => false,
                'expired_at' => Carbon::now()->addMonths(4),
            ]);

            } else { return redirect()->route('transaction.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
        
        return redirect()->route('transaction.index')->with(['success' => 'Data Berhasil Disimpan!', 'voucherCode' =>  $voucher->code, 
        'amount' => $voucher->amount, 'expired' => $voucher->expired_at]);
        // return response()->json(['transaction' => $transaction, 'voucher' => $voucher], 201);
    // }    
}
}
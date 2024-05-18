<?php

namespace App\Http\Controllers;
use App\Models\Voucher;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function checkVoucher(Request $request)
    {
        dd($request->all());
        $code = $request->input('code');
        
        $voucher = Voucher::where('code', $code)->first();
        
        if ($voucher) {
            return response()->json([
                'success' => true,
                'discount' => $voucher->amount
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kode voucher tidak valid.'
            ]);
        }
    }
}
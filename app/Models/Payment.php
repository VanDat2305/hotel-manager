<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;
    public function add($request)
    {
        $data['booking_id'] = $request->vnp_TxnRef;
        $data['money'] = $request->vnp_Amount;
        $data['note'] = $request->vnp_OrderInfo;
        $data['vnp_response_code'] = $request->vnp_ResponseCode;
        $data['code_vnpay'] = $request->vnp_TransactionNo;
        $data['code_bank'] = $request->vnp_BankCode;
        $data['time'] = $request->vnp_PayDate;
        return DB::table('payments')->insert($data);
    }
}

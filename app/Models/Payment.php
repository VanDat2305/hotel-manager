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
        $data['money'] = $request->vnp_Amount/100;
        $data['note'] = $request->vnp_OrderInfo;
        $data['vnp_response_code'] = $request->vnp_ResponseCode;
        $data['code_vnpay'] = $request->vnp_TransactionNo;
        $data['code_bank'] = $request->vnp_BankCode;
        $data['time'] = $request->vnp_PayDate;
        return DB::table('payments')->insert($data);
    }
    public static function getMoneyMonthly(){
        $monthRange = array();
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($monthRange, array(
                'month' => $month->month,
                'year' => $year
            ));
        }
        $totalMoney = Payment::
            where('vnp_response_code', '00')
            ->select(DB::raw('sum(money) as totalMoney'), DB::raw('MONTH(time) as month'))
            ->groupBy('month')
            ->get()->toArray();
        $staticMoneyFolowMonth = [];
        foreach ($monthRange as $month) {
            $total = 0;
            foreach ($totalMoney as $key => $value) {
                if ($value['month'] == $month['month']) {
                    $total = $value['totalMoney'];
                    break;
                }
            }
            $staticMoneyFolowMonth[] = $total;
            $months[] = $month['month'].'/'.$month['year'];
        }
        $data = [
            'time' => $months,
            'money' => $staticMoneyFolowMonth
        ];
        return $data;
    }
    public static function getMoneyCategory(){
        $data = [];
        $totalMoney = Payment::query()
            ->where('payments.vnp_response_code', '00')
            ->select(DB::raw('sum(payments.money) as totalMoney'),DB::raw('rooms.category_id') )
            ->join('bookings','bookings.id','payments.booking_id')
            ->join('rooms','rooms.id','bookings.room_id')
            ->groupBy('rooms.category_id')
            ->get();
        $category = Category::active()->get();
        foreach($category as $cate){
            $total = 0;
            foreach($totalMoney as $total){
               if ($cate['id'] == $total['category_id']) {
                    $total = $total['totalMoney'];
                    break;
               }
            }
            $data[] = $total;
        }
        return $data;
    }
}

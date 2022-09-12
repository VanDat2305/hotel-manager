<?php

namespace App\Models;

use App\Mail\MailPayment;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
    public function sentInvoice($booking_id){
        $bookings = Booking::find($booking_id);
        $contents['title'] = 'Payment';
        $contents['firstname'] = $bookings->customer->firstname;
        $contents['booking_id'] = $booking_id;
        $contents['name'] = $bookings->room->name;
        $contents['checkin'] = $bookings->check_in;
        $contents['checkout'] = $bookings->check_out;
        $contents['price'] =  $bookings->room->price;
        $contents['sub_price'] =  $bookings->sub_price;
        $contents['vat'] =  $bookings->sub_price*config('custom.vat')/100;
        $contents['total_price'] =  $bookings->total_price;
        Mail::to($bookings->customer->email)->send(new MailPayment($contents));
    }
    public static function revenueMoney($request){
        $from = $request->from != null ? Carbon::parse($request->from)->format("Y-m-d") : date_format(date_modify(now(), "-7 days"),"Y-m-d");
        $to = $request->to !=null ? Carbon::parse($request->to)->format("Y-m-d") : date_format(now(),"Y-m-d");
        $categories = Category::select('id','name')->get()->toArray();
        $totalMoney = Payment::query()
        ->where('payments.vnp_response_code', '00')
        ->select(DB::raw('sum(payments.money) as totalMoney'),DB::raw('rooms.category_id'),DB::raw(" date_format(date(payments.time),'%Y-%m-%d') AS date") )
        ->join('bookings','bookings.id','payments.booking_id')
        ->join('rooms','rooms.id','bookings.room_id')
        ->whereBetween('payments.time', [$from, $to])
        ->groupBy('rooms.category_id',DB::raw(" date_format(date(payments.time),'%Y-%m-%d') "))
        ->get();
        $model = new Payment();
        $dateArr = $model->getDatesFromRange($from,$to);
        $totalMoney = $totalMoney->toArray();
        $categories =  array_map(function($n) use ($dateArr, $totalMoney) {
            $n['data'] = [];
            $n['date'] = [];
            foreach ($dateArr as $key => $date) {
                $total = 0;
                foreach($totalMoney as $money){
                    if ($date == $money['date'] && $money['category_id'] == $n['id']) {
                        $total =  (int)$money['totalMoney'];
                    }
                } 
                array_push($n['data'],$total);
                array_push($n['date'],$date);
            }
            return $n;
        },$categories);
        return $categories;
    }
    public function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
        foreach($period as $date) { 
            $array[] = $date->format($format); 
        }
        return $array;
    }
}

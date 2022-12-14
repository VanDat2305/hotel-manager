<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;
    public function __construct()
    {
        Booking::where([
            ['check_in','<',NOW()],
            ['check_out','>',NOW()],
            ['status','=',1],
        ])->update(['status'=>5]);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function getFullnameAttribute($value)
    {
        return "{$this->customer->firstname} {$this->customer->lastname}";
    }
    public function getStatusAttribute($value)
    {
        $bookingStatus = null;
        switch ($value) {
            case config('custom.booking_status.Confirmed'):
                $bookingStatus = 'Confirmed';
                break;
            case config('custom.booking_status.Operational'):
                $bookingStatus = 'Operational';
                break;
            case config('custom.booking_status.Completed'):
                $bookingStatus = 'Completed';
                break;
            case config('custom.booking_status.Cancelled'):
                $bookingStatus = 'Cancelled';
                break;
            case config('custom.booking_status.Unsuccessful'):
                $bookingStatus = 'Unsuccessful';
                break;
            default:
                $bookingStatus = 'Confirmed';
                break;
        }

        return $bookingStatus;
    }
    public function getCheckBooked($room_id, $request)
    {
        $periods = $this->select('check_in', 'check_out')->where('room_id', $room_id)->get()->toArray();
        $date['check_in'] = Carbon::parse($request->input('checkin'))->format('Y-m-d H:i:s');
        $date['check_out'] = Carbon::parse($request->input('checkout'))->format('Y-m-d H:i:s');
        $data = [$date];
        $periods = array_merge($periods, $data);
        return $this->isRepeat($periods);
    }
    public function isRepeat($periods, $checkin = 'check_in', $checkout = 'check_out')
    {
        // s???p x???p
        usort($periods, function ($a, $b) use ($checkin, $checkout) {
            return strtotime($a[$checkin]) <=> strtotime($b[$checkout]);
        });
        // so s??nh 
        foreach ($periods as $key => $period) {
            if ($key != 0) {
                if (strtotime($period[$checkin]) < strtotime($periods[$key - 1][$checkout])) {
                    return true;
                }
            }
        }
        return false;
    }
    public static function calcPrice($start_time, $end_time, $room_id)
    {
        $totalDays =  Carbon::parse($start_time)->diffInDays(Carbon::parse($end_time))+1;
        $priceRoom = Room::find($room_id)->price;
        $price = $totalDays * $priceRoom ;
        return $price;
    }
    public function addBooking($request, $room_id)
    {
        $data['room_id'] = $room_id;
        $data['customer_id'] = Customer::addGetCustomerId($request->input());
        $data['check_in'] = Carbon::parse($request->input('checkin'))->format('Y-m-d H:i:s');
        $data['check_out'] = Carbon::parse($request->input('checkout'))->format('Y-m-d H:i:s');
        $data['infomation'] = $request->input('infomation');
        $data['sub_price'] = Booking::calcPrice($request->input('checkin'), $request->input('checkout'), $room_id);
        $data['total_price'] = $data['sub_price']+ ($data['sub_price']*config('custom.vat')/100);
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $res = DB::table('bookings')->insertGetId($data);
        return $res;
    }
    public function scopeComplete($query)
    {
        return $query->where('status', config('custom.booking_status_text.Completed'));
    }
    public function getDateAll($room_id)
    {
        $periods = $this->select('check_in', 'check_out')->where('room_id', $room_id)->get()->toArray();
        $arrDate = [];
        if (count($periods) == 0) {
            return $arrDate;
        }
        foreach ($periods as $booking) {
            $begin = new DateTime($booking['check_in']);
            $end = new DateTime($booking['check_out']);
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);
            $arrDay = [];
            foreach ($daterange as $date) {
                array_push($arrDay, $date->format("m-d-Y"));
            }
            array_push($arrDate, $arrDay);
        }
        $arrDate = array_merge([], ...$arrDate);
        return $arrDate;
    }
}

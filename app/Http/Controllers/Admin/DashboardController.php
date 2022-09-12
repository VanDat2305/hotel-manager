<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Room;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {

        $totalMoney = Payment::getMoneyMonthly();
        $this->v['months'] = $totalMoney['time'];
        $this->v['totalMoneyMonth'] =  $totalMoney['money'];
        $this->v['totalMoneyCate'] = Payment::getMoneyCategory();
        $this->v['title'] = __('DASHBOARD');
        $this->v['category'] = Category::active()->get();
        $this->v['countRoom'] = Room::active()->get()->count();
        $this->v['countCustomer'] = Customer::active()->get()->count();
        $this->v['countBooking'] = Booking::complete()->get()->count();
        return view('admin.dashboard', $this->v);
    }
    public function showChart(Request $request)
    {
        $totalMoney = Payment::revenueMoney($request);
        $this->v['category'] = Category::active()->get();
        $this->v['title'] = __('Statistic');
        $this->v['text_totalmoney'] = __('Total Revenue');
        $this->v['dataMoney'] =  $totalMoney;
        // dd( $totalMoney);
        $this->v['date'] = $totalMoney[0]['date'];
        return view('admin.statistic', $this->v);
    }
}
//SELECT DATEDIFF(DATE_FORMAT(check_out, '%Y/%m/%d'),DATE_FORMAT(check_in, '%Y/%m/%d')) AS DATEDIFF,
//(total_price/DATEDIFF(DATE_FORMAT(check_out, '%Y/%m/%d'),DATE_FORMAT(check_in, '%Y/%m/%d'))) AS Money FROM bookings;

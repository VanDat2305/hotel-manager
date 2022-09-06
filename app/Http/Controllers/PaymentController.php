<?php

namespace App\Http\Controllers;

use App\Mail\MailPayment;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{

    public function create(Request $request)
    {
        $host = $request->getHttpHost() ;
        $model = Booking::find($request->booking_id);
        if ($model) {
            $id_booking = $model->id;
            $vnp_Returnurl = "http://".$host."/admin/booking/vnpayAdmin_return";
        }else{
            $model = new Booking();
            $id_booking = $model->addBooking($request, $request->room_id);
            $vnp_Returnurl = "http://".$host."/vnpay_return";
        }
        $vnp_TmnCode = "70N50ZKL"; //Website ID in VNPAY System
        $vnp_HashSecret = "RAPNIYTGEOHTNCTYNVPGUDIYCALAKMEH"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        $vnp_TxnRef = $id_booking; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan hoa don";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $request->total_price *100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
    public function vnpay_return(Request $request)
    {
        $model = new Payment;
        if ($request->vnp_ResponseCode == "00") {
            $model->add($request);
            $model->sentInvoice($request->vnp_TxnRef);
            Alert::success(__('payment successful'));
            return redirect()->route('home');
        }
        Alert::error(__('payment error'));
        return redirect()->back();
    }
    public function vnpayAdminReturn(Request $request)
    {
        $model = new Payment;
        if ($request->vnp_ResponseCode == "00") {
            $model->add($request);
            $model->sentInvoice($request->vnp_TxnRef);
            Alert::success(__('payment successful'));
            return redirect()->route('admin.booking.index');
        }
        Alert::error(__('payment error'));
        return redirect()->back();
    }

}

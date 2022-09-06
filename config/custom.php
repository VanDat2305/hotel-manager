<?php
return [
    'user_roles' => [
        'admin' => '1',
        'manager' => '2',
    ],
    'user_status' => [
        'block' => '0',
        'active' => '1',
    ],
    'user_status_text' => [
        'block' => 'block',
        'active' => 'active',
    ],
    'customer_status' => [
        'block' => '0',
        'active' => '1',
    ],
    'customer_status_text' => [
        'block' => 'block',
        'active' => 'active',
    ],
    'category_status' => [
        'block' => '0',
        'active' => '1',
    ],
    'category_status_text' => [
        'block' => 'block',
        'active' => 'active',
    ],
    'color-status' =>[
        'block' => 'btn-danger',
        'active' => 'btn-success',
    ],
    'room_status' => [
        'block' => '0',
        'active' => '1',
    ],
    'room_status_text' => [
        'block' => 'block',
        'active' => 'active',
    ],
    'limit_page' =>[
        'category' => 5,
        'customer' => 5,
        'room' => 5,
        'user' => 5,
        'booking' => 5,
        'room-booking' => 10,
        'room-client' => 3
    ],
    'booking_status' => [
        'Confirmed'=> '0',
        'Operational' => '1', 
        'Completed'=> '2',
        'Cancelled'=> '3',
        'Unsuccessful' => '4'
    ],
    'booking_status_text' => [
        'Confirmed'=> 'Confirmed',
        'Operational' => 'Operational', 
        'Completed'=> 'Completed',
        'Cancelled'=> 'Cancelled',
        'Unsuccessful' => 'Unsuccessful'
    ],
    'booking_color' => [
        'Confirmed'=> 'bg-indigo',
        'Operational' => 'bg-navy', 
        'Completed'=> 'bg-purple',
        'Cancelled'=> 'bg-fuchsia',
        'Unsuccessful' => 'bg-maroon'
    ],
    'vat' => 10,
    'vnpayStatus'=> [
        '00' =>	'Giao dịch thanh toán thành công',
        '01' =>	'Giao dịch chưa hoàn tất',
        '02' =>	'Giao dịch bị lỗi',
        '04' =>	'Giao dịch đảo' ,
        '05' =>	'VNPAY đang xử lý giao dịch này' ,
        '06' =>	'VNPAY đã gửi yêu cầu hoàn tiền sang Ngân hàng' ,
        '07' =>	'Giao dịch bị nghi ngờ gian lận',
        '09' =>	'GD Hoàn trả bị từ chối'
    ]
];
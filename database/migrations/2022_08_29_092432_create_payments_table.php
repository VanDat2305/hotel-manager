<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->integer('money')->comment('Số tiền thanh toán');
            $table->string('note')->nullable()->comment('Nội dung thanh toán');
            $table->string('vnp_response_code')->comment('Mã phản hồi');
            $table->string('code_vnpay')->comment('Mã giao dịch');
            $table->string('code_bank')->comment('Mã ngân hàng');
            $table->datetime('time')->comment('Thời gian thanh toán');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};

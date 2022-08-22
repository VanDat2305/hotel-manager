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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id');
            $table->integer('user_id');
            $table->integer('coupon_id')->nullable();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->string('infomation');
            $table->integer('sub_price');
            $table->integer('total_price');
            $table->enum('status',[0,1,2,3,4])->default(0)->comment('0:Confirmed,1:Operational, 2:Completed, 3:Cancelled, 4:Unsuccessful' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    protected  $appends = ['fullname'];
    public function getFullnameAttribute($value){
        return "{$this->firstname} {$this->lastname}";
    }
    public function getStatusAttribute($value)
    {
        $customerStatus = null;
        switch ($value) {
            case config('custom.customer_status.active'):
                $customerStatus = 'active';
                break;
            case config('custom.customer_status.block'):
                $customerStatus = 'block';
                break;
            default:
                $customerStatus = 'active';
                break;
        }

        return $customerStatus;
    }
    public static function addGetCustomerId($request){
        $customer = Customer::select('id')->where('email',$request['email'])->first();
        if ($customer == null) {
            $id = DB::table('customers')->insertGetId([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'address' => $request['address'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]); 
            return $id;
        }else{
            return $customer->id;
        }
    }
    public function scopeActive($query){
        return $query->where('status',config('custom.customer_status.active'));
    }
}

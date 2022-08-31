<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'category_id', 'image', 'description', 'status'];
    public function getStatusAttribute($value)
    {
        $roomStatus = null;
        switch ($value) {
            case config('custom.room_status.active'):
                $roomStatus = 'active';
                break;
            case config('custom.room_status.block'):
                $roomStatus = 'block';
                break;
            default:
                $roomStatus = 'active';
                break;
        }

        return $roomStatus;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function statusRoomNow()
    {
        $ArrayParent = DB::table('bookings')->select('bookings.room_id')
            ->where('bookings.check_in', '<', NOW())
            ->where('bookings.check_out', '>', NOW())
            ->get()->toArray();
            foreach($ArrayParent as $array){
                foreach($array as $val){
                    $arrChild[] = $val;
                }
            }
        $rooms =  DB::table('rooms')->select('rooms.name' , 'rooms.id', 'categories.name as nameCate','rooms.image')
            ->join('categories', 'rooms.category_id', '=', 'categories.id')
            ->whereNotIn('rooms.id',$arrChild)
            ->orderBy('category_id','ASC')
            ->paginate(config('custom.limit_page.room-booking'));
        return $rooms;
    }
    public function scopeActive($query)
    {
        return $query->where('status', config('custom.room_status.active'));
    }
    public static function searchByDate($request){
        $datas = Booking::select('room_id')
        ->where('check_in','<=',$request->checkin)
        ->where('check_out','>=',$request->checkout)
        ->get()->toArray();
        $listId = [];
         foreach($datas as $data){
            foreach($data as $i){
               array_push($listId,$i);
            }
        }
        $rooms =  DB::table('rooms')->select('rooms.*','categories.name as cateName')
            ->join('categories','rooms.category_id','=','categories.id')
            ->where('rooms.category_id',$request->category_id)
            ->whereNotIn('rooms.id',$listId)
            // ->active()
            ->paginate(config('custom.limit_page.room'));
        return $rooms;
    }
    public static function getRoom($param = null){
        $query = Room::select('rooms.*',DB::raw('(SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END AS BIT
        From Bookings Where Bookings.room_id = rooms.id) as empty') );
        $param != null ? $query = $query->where('category_id',$param) : "";
        $query = $query->paginate(config('custom.limit_page.room'));
        return $query;
    }
}

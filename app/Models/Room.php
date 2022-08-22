<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','category_id','image','description','status'];
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
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function scopeActive($query){
        return $query->where('status',config('custom.room_status.active'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_id','status'];
    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function getStatusAttribute($value)
    {
        $categoryStatus = null;
        switch ($value) {
            case config('custom.category_status.active'):
                $categoryStatus = 'active';
                break;
            case config('custom.category_status.block'):
                $categoryStatus = 'block';
                break;
            default:
                $categoryStatus = 'active';
                break;
        }
        return $categoryStatus;
    }
    public function scopeActive($query)
    {
        return $query->where('status',config('custom.category_status.active'));
    }
}

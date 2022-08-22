<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $fillable = ['email', 'name', 'phone', 'password', 'status', 'image'];
    protected $guarded = ['role_id'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getStatusAttribute($value)
    {
        $userStatus = null;
        switch ($value) {
            case config('custom.user_status.active'):
                $userStatus = 'active';
                break;
            case config('custom.user_status.block'):
                $userStatus = 'block';
                break;
            default:
                $userStatus = 'active';
                break;
        }

        return $userStatus;
    }
    public function update_role($id,$role){
        DB::table('users')->where('id',$id)->update(['role_id'=>$role]);
    }
}


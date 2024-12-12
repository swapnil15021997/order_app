<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_name',
        'user_phone_number',
        'user_address',
        'user_password',
        'user_sweetword',
        'user_hash_pass',
        'user_role_id',
        'user_module_id',
        'user_permission_id',
        'user_active_branch'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    

    public static function get_data_by_phone_no($phone){
        $user = User::where('user_phone_number',$phone)->first();
        return $user;
    }

    public static function get_user_by_id($user_id){
        $user = User::where('id',$user_id)->where('is_delete',0)->first();
        return $user;
    }


    public static function get_data_by_user_name($name){
        $user = User::where('user_name',$name)->first();
        return $user;

    }

    public static function get_data_by_email($user_email){
        $user = User::where('email',$user_email)->where('is_delete',0)->first();
        return $user;

    }
}

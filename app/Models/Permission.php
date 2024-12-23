<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    // Define the fillable fields
    protected $fillable = [
        'permission_name',
        'permission_module_id',
        'permission_status'
    ];


    // public static function get_role_by_id($role_id){
    //     $user = UserRole::where('role_id',$role_id)->first();
    //     return $user;
    // }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id'); 
    }
}

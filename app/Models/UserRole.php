<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserRole extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user_roles';
    protected $primaryKey = 'role_id';
  

    // Define the fillable fields
    protected $fillable = [
        'role_name',
        'role_status',
        'deleted_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_role_id', 'role_id');
    }
    public static function get_role_by_id($role_id){
        $user = UserRole::where('role_id',$role_id)->first();
        return $user;
    }
}

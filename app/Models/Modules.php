<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Permission;


class Modules extends Model
{
    use HasFactory;

    protected $table = 'modules';
    protected $fillable = [
        'module_name',
        'created_at',
        'updated_at'  
    ];

    public function permissions()
    {

        return $this->hasMany(Permission::class, 'permission_module_id', 'module_id');
    }
    
    public static function get_modules_with_permissions(){

        $permissions = Modules::with('permissions:permission_id,permission_name,permission_module_id') 
            ->select('module_id', 'module_name')
            ->get()
            ->toArray();
        return $permissions;
    }

    //
}

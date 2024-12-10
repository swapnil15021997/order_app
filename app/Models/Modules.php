<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Permission;


class Modules extends Model
{
    use HasFactory;

    protected $table = 'modules';


    public function permissions()
    {

        return $this->hasMany(Permission::class, 'permission_module_id', 'module_id');
        }
 
    //
}

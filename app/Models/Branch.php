<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branch';
    
    protected $primaryKey = 'branch_id';
    protected $fillable = [
        'branch_name',
        'branch_address',
        'branch_added_by',
    ];

    public static function get_branch_by_id($branch_id){
        $branch = Branch::where('branch_id',$branch_id)->first();
        return $branch;
    }

    public static function get_all_branch(){
        $branch = Branch::where('is_delete',0)->get()->toArray();
        return $branch;
    }

    public static function get_latest_branch(){
        $branch = Branch::where('is_delete',0)->take(5)->get()->toArray();
        return $branch;
    }

    public static function get_users_branch(){
       $branch =  Branch::whereIn('branch_id', $userBranchIds)->where('is_delete',0)->get()->toArray();
        return $branch;
    }
}

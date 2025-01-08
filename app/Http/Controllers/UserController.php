<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Permission;
use App\Models\Modules;
use App\Models\Branch;
use Carbon\Carbon;
class UserController extends Controller
{
    //

    public function user_index(Request $request){

        $login = auth()->user();

        $users = User::take(5)->get()->toArray();
        // $role  = UserRole::
        $activePage = 'users';
        if(!empty($login)){
            if($login['user_role_id'] != 1){

                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 
              
                if(!empty($userBranchIds)){

                    $users_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $users_branch  = [];
                }
                
            }else{
                $users_branch  = Branch::get_all_branch();
    
            }
            foreach ($users_branch as $branch) {
                if ($branch['branch_id'] == $login['user_active_branch']) {
                    $activeBranchName = $branch['branch_name'];
                    break;
                }
            }
            $activeBranchName ='';
        }

        $user_permissions = session('combined_permissions', []);
        
        $roles = UserRole::get_roles_with_count();
            
        $modules = Modules::get_modules_with_permissions();

        return view('users/users',['users' => $users,
            'pageTitle'=>'Users','login'=>$login,
            'activePage'=>$activePage,'user_branch'=>$users_branch,
            'user_permissions'=>$user_permissions,
            'roles'=>$roles, 'modules'=>$modules,
            'activeBranchName'=>$activeBranchName
        ]);
    }

    public function user_add(Request $request){
        $users = User::take(5)->get()->toArray();
        $roles = UserRole::select('role_id', 'role_name')->get()->toArray();
        $login = auth()->user();

        $modules = Modules::get_modules_with_permissions();
        $activePage = 'users';
        $branch     = Branch::get_all_branch();

        if(!empty($login)){
            if($login['user_role_id'] != 1){

                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 
                 
                if(!empty($userBranchIds)){

                    $users_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $users_branch  = [];
                }
                
            }else{
                $users_branch  = Branch::get_all_branch();
    
            }
            foreach ($users_branch as $b) {
                if ($b['branch_id'] == $login['user_active_branch']) {
                    $activeBranchName = $b['branch_name'];
                    break;
                }
            }
            $activeBranchName ='';
        }

        $user_permissions = session('combined_permissions', []);
        
        return view('users/user_add',['users' => $users,'login'=>$login,
        'activePage'=>$activePage,'branch'=>$branch,'pageTitle'=>'User Add',
        'roles' => $roles, 'modules'=>$modules,'user_branch'=>$users_branch,'user_permissions'=>$user_permissions,'activeBranchName'=>$activeBranchName]);
    }


    public function user_add_edit(Request $request)
    {    
        $params = $request->all();

        $rules = [   
            'user_id'           => ['nullable','string'],
            'user_name'         => ['required','string'],  
            'user_email'         => ['required','email'],  
            'user_address'      => ['nullable','string','max:255'],
            'user_phone_number' => ['nullable','regex:/^\d{10,13}$/'],
            'user_role'         => ['required','string'],
            'user_permission'   => ['required','string','max:255'],
            'user_module'       => ['required','string','max:13'],
            'user_branch'       => ['required'],
            
            ]; 
        $messages = [
            'user_name.required'         => 'User name is required.',
            'user_name.string'           => 'User name must be a string.',
            // 'user_address.required'      => 'Address is required.',
            'user_address.string'        => 'Address must be a string.',
            'user_address.max'           => 'Address cannot exceed 255 characters.',
            // 'user_phone_number.required' => 'Phone number is required.',
            'user_phone_number.integer'   => 'Phone number must be a number.',
            'user_phone_number.max'      => 'Phone number cannot exceed 13 characters.',
            'user_role.required'         => 'User role is required.',
            'user_role.string'           => 'User role must be a string.',
            'user_permission.required'   => 'Please provide permission',
            'user_branch.required'       => 'Please select branch',
            'user_module.required'       => 'Please provide modules',
            'user_email.required'        => 'User email is required.',
            'user_email.email'           => 'User email must be a valid email.',
      
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $check_role = UserRole::get_role_by_id($params['user_role']);
        if (empty($check_role)){
            return response()->json([
                'status' => 500,
                'message' => 'User role does not exist'
            ]);
        }

        $moduleIds       = !empty($params['user_modules']) ? explode(',', $params['user_modules']) : [];
        $permissionIds   = !empty($params['user_permission']) ? explode(',', $params['user_permission']) : [];
            //   = !empty($params['user_branch']) ? explode(',', $params['user_branch']) : [];

        $existingModules = Modules::whereIn('module_id', $moduleIds)->pluck('module_id')->toArray();

        if (count($existingModules) !== count($moduleIds)) {
            return response()->json([
                'status' => 500,
                'message' => 'One or more modules do not exist.',
            ]);
        }    
        $existingPermissions = Permission::whereIn('permission_id', $permissionIds)->pluck('permission_id')->toArray();
        
        if (count($existingPermissions) !== count($permissionIds)) {
            return response()->json([
                'status' => 500,
                'message' => 'One or more permissions do not exist.',
            ]);
        }
        $userModuleIds     = implode(',', $moduleIds);       
        $userPermissionIds = implode(',', $permissionIds);  
        $branchIds         = implode(',', $params['user_branch']);   
        
        if (empty($params['user_id'])){
            $get_data = User::get_data_by_phone_no($params['user_phone_number']);
            
           
            if (!empty($get_data)){
                return response()->json([
                    'status' => 500,
                    'message' => 'User already exist with phone number'
                ]); 
            }
            $get_data = User::get_data_by_email($params['user_email']);
            
            if (!empty($get_data)){
                return response()->json([
                    'status' => 500,
                    'message' => 'User already exist with phone number'
                ]); 
            }
            $get_data = User::get_data_by_user_name($params['user_name']);
            if (!empty($get_data)){
                return response()->json([
                    'status' => 500,
                    'message' => 'User already exist'
                ]); 
            }
            $combined_permissions = session('combined_permissions', []);
             
            if(! in_array(11 ,$combined_permissions)){
                return response()->json([
                    'status' => 500,
                    'message' => 'You dont have permission to add User' 
                ]);
            }
           
            $user = new User();
            $user->name                  = $params['user_name'];
            $user->user_name             = $params['user_name'];
            $user->email                 = $params['user_email'];
            $user->user_address          = $params['user_address'];
            $user->user_phone_number     = $params['user_phone_number'];
            $user->user_role_id          = $params['user_role'];
            $user->password              = Hash::Make('Test@123'); 
            $user->user_sweetword        = 'Test@123'; 
            $user->user_module_id        = $userModuleIds;
            $user->user_permission_id    = $userPermissionIds;
            $user->user_branch_ids       = $branchIds;
        
            $user->save();
        
            return response()->json([
                'status' => 200,
                'message' => 'User added successfully!',
                'user' => $user,
            ]);
        }else{
           
            $user = User::get_user_by_id($params['user_id']);
            if (!$user) {
                return response()->json([
                    'status' => 500,
                    'message' => 'User not found.',
                ]);
            }

            $combined_permissions = session('combined_permissions', []);
            if(! in_array(10 ,$combined_permissions)){
                return response()->json([
                    'status' => 500,
                    'message' => 'You dont have permission to update User' 
                ]);
            }
            if($user->user_phone_number != $params['user_phone_number']){
                $get_data = User::get_data_by_phone_no($params['user_phone_number']);
                if (!empty($get_data)){
                    return response()->json([
                        'status' => 500,
                        'message' => 'User already exist'
                    ]); 
                }
            }
            
            $user->user_name             = $params['user_name'];
            $user->user_address          = $params['user_address'];
            $user->user_phone_number     = $params['user_phone_number'];
            $user->email                 = $params['user_email'];
            $user->user_module_id        = $moduleIds;
            $user->user_permission_id   = $userPermissionIds;
            $user->user_branch_ids       = $branchIds;        
            $user->user_role_id          = $params['user_role'];
            
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'User updated successfully!'
            ]);
        }
    }

    public function edit_user(Request $request,$user_id){
        $user = User::get_user_by_id($user_id);
        if (!$user) {
            return response()->json([
                'status' => 500,
                'message' => 'User not found.',
            ]);
        }
        $roles = UserRole::select('role_id', 'role_name')->get()->toArray();
        
        $modules = Modules::get_modules_with_permissions();     
            
        $branch     = Branch::get_all_branch();
        $login = auth()->user();
       
        if(!empty($login)){
            if($login['user_role_id'] != 1){
                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 

                if(!empty($userBranchIds)){

                    $users_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $users_branch  = [];
                }
                
            }else{
                $users_branch  = Branch::get_all_branch();
    
            }
            foreach ($users_branch as $branch) {
                if ($branch['branch_id'] == $login['user_active_branch']) {
                    $activeBranchName = $branch['branch_name'];
                    break;
                }
            }
            $activeBranchName ='';
        }
        $user_branch =  explode(',', $user['user_branch_ids']);
        $userBranchId = array_map('trim', $user_branch); 
        $userBranchId = array_filter($userBranchId); 

        if(!empty($userBranchId)){

            $user_branch  = Branch::get_users_branch($userBranchId);
        }else{
            $user_branch  = [];
        }
        
        $branch       = Branch::get_all_branch();

        $user_permissions = session('combined_permissions', []);
        
        return view('users/user_edit',['user' => $user,'roles'=>$roles,
            'modules'=>$modules,'user_branch'=>$users_branch,
            'edit_user_branch'=>$user_branch,'login'=>$login,
            'pageTitle'=>'User Edit','activePage'=>'users',
            'branch'=>$branch,'user_permissions'=>$user_permissions,

            'activeBranchName'=>$activeBranchName
        ]);
    }

    public function user_remove(Request $request)
    {    

        $params = $request->all();
             
        $rules = [   
            'user_id'           => ['required','string']
            ]; 
        $messages = [
            'user_id.required'         => 'User id is required.',
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $user = User::get_user_by_id($params['user_id']);
        if (!$user) {
            return response()->json([
                'status' => 500,
                'message' => 'User not found.',
            ]);
        }
        $combined_permissions = session('combined_permissions', []);
        if(! in_array(12 ,$combined_permissions)){
            return response()->json([
                'status' => 500,
                'message' => 'You dont have permission to delete User' 
            ]);
        }
        $user->is_delete = 1;
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'User removed successfully!'
        ]);
    }   

    public function user_list(Request $request)
    {    

        $rules = [
            'search'   => ['nullable', 'string'], 
            'per_page' => ['nullable', 'integer', 'min:1'], 
            'page'     => ['nullable', 'integer', 'min:1'], 
        ];
    
        $messages = [
            'search.string'   => 'Search query must be a valid string.',
            'per_page.integer' => 'Items per page must be a valid integer.',
            'per_page.min'     => 'Items per page must be at least 1.',
            'page.integer'     => 'Page number must be a valid integer.',
            'page.min'         => 'Page number must be at least 1.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0],
                'errors'  => $validator->errors(),
            ]);
        }
    
        $searchQuery = $request->input('search', ''); 
        $perPage     = $request->input('per_page', 15);   
        $page        = $request->input('page', 1);   
        $offset      = ($page - 1) * $perPage;
        $sortColumn  = $request->input('sort', 'id'); 
        $sortOrder   = $request->input('sortOrder', 'desc'); 
        $allowedSortColumns = ['id', 'user_name'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id'; 
        }
        $usersQuery = User::query()
        ->leftJoin('user_roles as roles', 'users.user_role_id', '=', 'roles.role_id')
        ->select(
            'users.id',
            'users.user_name',
            'users.user_phone_number',
            'roles.role_name'
        )->where('users.is_delete',0)
        ->orderBy($sortColumn, $sortOrder);       
        if (!empty($searchQuery)) {
            $usersQuery->where(function ($query) use ($searchQuery) {
                $query->where('user_name', 'like', "%{$searchQuery}%")
                      ->orWhere('user_phone_number', 'like', "%{$searchQuery}%");
            });
        }

        
        $total_users = $usersQuery->count();
        $users = $usersQuery
        ->offset($offset)
        ->limit($perPage)
        ->get();
        $users->each(function ($user, $index) {
            $user->serial_number = $index + 1; 
        });
        $total_pages = ceil($total_users / $perPage);

        return response()->json([
            'status' => 200,
            'message' => 'User list fetched successfully!',
            'data'    => [
                'users'     => $users,
                'total'        => $total_users,
                'per_page'     => $perPage,
                'current_page' => $page,
                'total_pages'  => $total_pages,
            ],
            'recordsTotal'  => $total_users,
            'recordsFiltered' => $users->count(),
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages'  => $total_pages,
        ]);
    

    }


    public function user_details(Request $request){
        
        $params = $request->all();
             
        $rules = [   
            'user_id'           => ['required','string']
            ]; 
        $messages = [
            'user_id.required'         => 'User id is required.',
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $user = User::get_user_by_id($params['user_id']);
        if (!$user) {
            return response()->json([
                'status' => 500,
                'message' => 'User not found.',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'User details fetch successfully.',
            'data' => $user
   
        ]);
    }



    // Roles and permissions

    public function role_index(Request $request){

        $login = auth()->user();


        // $role  = UserRole::
        $activePage = 'roles';
        $login = auth()->user();

        if(!empty($login)){
            $userBranchIds = explode(',', $login['user_branch_ids']);
        }
        // $branch       = Branch::get_all_branch();
        $users_branch = Branch::whereIn('branch_id', $userBranchIds)->get()->toArray();
        $user_permissions = session('combined_permissions', []);

        return view('users/roles',['pageTitle'=>'Roles','login'=>$login,'activePage'=>$activePage,'user_branch'=>$users_branch,'user_permissions'=>$user_permissions]);
    }

    public function permission_list(Request $request){
        
        $permission_list = Permission::where('is_delete', false)->get();  

        return response()->json([
            'status' => 200,
            'message' => 'Permission list fetch successfully.',
            'data' => $permission_list
   
        ]);
    }


    // Roles 

    public function role_add_and_edit(Request $request){
        $params = $request->all();
             

        $rules = [   
            'role_id'           => ['nullable','string'],
            'role_name'         => ['required','string'],  
            'user_permission'   => ['required','string','max:255'],
            'user_module'       => ['required','string','max:13'],
        ]; 
        $messages = [
            'role_name.required'         => 'Role name is required.',
            'role_name.string'           => 'Role name must be a string.',
            'user_permission.required'   => 'Please provide permission',
            'user_module.required'       => 'Please provide modules'
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $moduleIds = explode(',', $params['user_module']);
        $permissionIds = explode(',', $params['user_permission']);
        $existingModules = Modules::whereIn('module_id', $moduleIds)->pluck('module_id')->toArray();
        if (count($existingModules) !== count($moduleIds)) {
            return response()->json([
                'status' => 500,
                'message' => 'One or more modules do not exist.',
            ]);
        }    
        

       
        if (empty($params['role_id'])){
            $combined_permissions = session('combined_permissions', []);
            if(! in_array(15 ,$combined_permissions)){
                return response()->json([
                    'status' => 500,
                    'message' => 'You dont have permission to add Role' 
                ]);
            }
            $user_role = new UserRole();
            $user_role->role_name         = $params['role_name'];
            $user_role->role_module_ids = implode(',', $moduleIds);
            $user_role->role_permission_ids = implode(',', $permissionIds);

            $user_role->save();
        
            return response()->json([
                'status' => 200,
                'message' => 'User Role added successfully!'
            ]);
        }else{
            $check_role = UserRole::get_role_by_id($params['role_id']);
            if (empty($check_role)){
                return response()->json([
                    'status' => 500,
                    'message' => 'User role does not exist'
                ]);
            }
            $combined_permissions = session('combined_permissions', []);
            if(! in_array(14 ,$combined_permissions)){
                return response()->json([
                    'status' => 500,
                    'message' => 'You dont have permission to add Role' 
                ]);
            }
    
            $check_role->role_name = $params['role_name'];
            
            $check_role->role_module_ids = implode(',', $moduleIds);
            $check_role->role_permission_ids = implode(',', $permissionIds);
    
            $check_role->save();
            return response()->json([
                'status' => 200,
                'message' => 'Role updated successfully!'
            ]);
        }
    }

   

    public function role_add(Request $request){

        $roles = UserRole::select('role_id', 'role_name')->get()->toArray();
        
        $modules = Modules::with('permissions:permission_id,permission_name,permission_module_id') 
            ->select('module_id', 'module_name')
            ->get()
            ->toArray();
        $login = auth()->user();

        $activePage = 'Role';
        if(!empty($login)){
            $userBranchIds = explode(',', $login['user_branch_ids']);
            $userBranchIds = array_map('trim', $userBranchIds); 
            $userBranchIds = array_filter($userBranchIds); 
        
            if(!empty($userBranchIds)){

                $users_branch  = Branch::get_users_branch($userBranchIds);
            }else{
                $users_branch  = [];
            }
        }
        // $branch       = Branch::get_all_branch();
        $users_branch = Branch::whereIn('branch_id', $userBranchIds)->get()->toArray();
        $user_permissions = session('combined_permissions', []);

        return view('users/role_add',['roles' => $roles, 'modules'=>$modules,
        'login'=>$login,'activePage'=>$activePage,'user_branch'=>$users_branch,'user_permissions'=>$user_permissions]);
    }

    public function role_list(Request $request){
        $rules = [
            'search'   => ['nullable', 'string'], 
            'per_page' => ['nullable', 'integer', 'min:1'], 
            'page'     => ['nullable', 'integer', 'min:1'], 
        ];
    
        $messages = [
            'search.string'   => 'Search query must be a valid string.',
            'per_page.integer' => 'Items per page must be a valid integer.',
            'per_page.min'     => 'Items per page must be at least 1.',
            'page.integer'     => 'Page number must be a valid integer.',
            'page.min'         => 'Page number must be at least 1.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0],
                'errors'  => $validator->errors(),
            ]);
        }
    
        $searchQuery = $request->input('search', ''); 
        $perPage     = $request->input('per_page', 15);   
        $page        = $request->input('page', 1);   
        $offset      = ($page - 1) * $perPage;
   
        $rolesQuery = UserRole::query();       
        if (!empty($searchQuery)) {
            $rolesQuery->where(function ($query) use ($searchQuery) {
                $query->where('role_name', 'like', "%{$searchQuery}%");
            });
        }

        
        $total_roles = $rolesQuery->count();
        $roles = $rolesQuery
        ->offset($offset)
        ->limit($perPage)
        ->get();
        $total_pages = ceil($total_roles / $perPage);

        return response()->json([
            'status' => 200,
            'message' => 'Role list fetched successfully!',
            'data'    => [
                'roles'        => $roles,
                'total'        => $total_roles,
                'per_page'     => $perPage,
                'current_page' => $page,
                'total_pages'  => $total_pages,
            ],
        ]);
    }

    public function edit_role(Request $request,$role_id){
        $login = auth()->user();

        $role = UserRole::get_role_by_id($role_id);
        if (!$role) {
            return response()->json([
                'status' => 500,
                'message' => 'User Role not found.',
            ]);
        }
        
        $modules = Modules::with('permissions:permission_id,permission_name,permission_module_id') 
            ->select('module_id', 'module_name')
            ->get()
            ->toArray();
        $rolePermissions = explode(',', $role->role_permission_ids);
        $activePage = 'Role';
        if(!empty($login)){
            $userBranchIds = explode(',', $login['user_branch_ids']);
        }
        // $branch       = Branch::get_all_branch();
        $users_branch = Branch::whereIn('branch_id', $userBranchIds)->get()->toArray();
        $user_permissions = session('combined_permissions', []);

        return view('users/role_edit',[
            'login'           => $login,
            'modules'         => $modules,
            'role'            => $role,
            'rolePermissions' => $rolePermissions,
            'activePage'      => $activePage,
            'user_branch'     => $users_branch,
            'user_permissions'=>  $user_permissions

        ]);
    }
    public function role_details(Request $request){
        $params = $request->all();
             
        $rules = [   
            'role_id'           => ['required','string']
            ]; 
        $messages = [
            'role_id.required'         => 'Role id is required.',
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $check_role = UserRole::get_role_by_id($params['role_id']);
        if (empty($check_role)){
            return response()->json([
                'status' => 500,
                'message' => 'User role does not exist'
            ]);
        }


        return response()->json([
            'status' => 200,
            'message' => 'Role details fetch successfully.',
            'data' => $check_role
   
        ]);
    }
    public function role_remove(Request $request){
        $params = $request->all();
             
        $rules = [   
            'role_id'           => ['required','string']
            ]; 
        $messages = [
            'role_id.required'         => 'Role id is required.',
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $combined_permissions = session('combined_permissions', []);
        if(! in_array(16 ,$combined_permissions)){
            return response()->json([
                'status' => 500,
                'message' => 'You dont have permission to delete Role' 
            ]);
        }
        $check_role = UserRole::get_role_by_id($params['role_id']);
        if (empty($check_role)){
            return response()->json([
                'status' => 500,
                'message' => 'User role does not exist'
            ]);
        }
        $check_role->deleted_at =  Carbon::now();
        $check_role->save();
        return response()->json([
            'status' => 200,
            'message' => 'Role removed successfully.'
        ]);
    }

    
}

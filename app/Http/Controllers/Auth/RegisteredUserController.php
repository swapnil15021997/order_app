<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'user_name'         => ['required','string'],  
            'user_address'      => ['required','string','max:255'],
            'user_phone_number' => ['required','string','max:13'],
            'user_role'         => ['required','string']
                    
        ];
        $messages = [
            'user_name.required'         => 'User name is required.',
            'user_name.string'           => 'User name must be a string.',
            'user_address.required'      => 'Address is required.',
            'user_address.string'        => 'Address must be a string.',
            'user_address.max'           => 'Address cannot exceed 255 characters.',
            'user_phone_number.required' => 'Phone number is required.',
            'user_phone_number.string'   => 'Phone number must be a string.',
            'user_phone_number.max'      => 'Phone number cannot exceed 13 characters.',
            'user_role.required'         => 'User role is required.',
            'user_role.string'           => 'User role must be a string.',
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

        $moduleIds      = explode(',', $check_role->user_module_ids);
        $permissionIds  = explode(',',$check_role->user_permission_ids);

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

        $get_data = User::get_data_by_phone_no($params['user_phone_number']);
            if (!empty($get_data)){
                return response()->json([
                    'status' => 500,
                    'message' => 'User does not exist'
                ]); 
            }
          

        $user = User::create([
            'name'                => $request->name,
            'email'               => $request->email,
            'password'            => Hash::make($request->string('password')),
            'user_name'           => $params['user_name'],
            'user_address'        => $params['user_address'],
            'user_phone_number'   => $params['user_phone_number'],
            'user_role_id'        => $params['user_role'],
            'user_sweetword'      => $request->string('password'),
            'user_module_ids'     => $moduleIds,
            'user_permission_ids' => $permissionIds

        ]);
        event(new Registered($user));

        Auth::login($user);
        return response()->json([
            'status' => 200,
            'message' => 'User registered successfully!',
            'user' => $user,
        ]);

        // return response()->noContent();
    }
    
}
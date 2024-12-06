<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use DB;
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create()
     {

        return view('auth.reset-password');  
     }
   
    public function store(Request $request): JsonResponse
    {

        // $params = $request->all();
        // $params['password'] = trim($params['password']);
        // $params['password_confirmation'] = trim($params['password_confirmation']);
        // $rules = [   
        //     'old_password'          =>['required', 'string'],
        //     'password'              => ['required', 'string'],
        //     'password_confirmation' => ['required', 'string'],
        // ]; 
        // $messages = [
        //     'old_password.required'   => 'Password is required',
        //     'old_password.string'     => 'Enter valid Password',
            
        //     'password.required'   => 'Password is required',
        //     'password.string'     => 'Enter valid Password',
        //     'password_confirmation.required'   => 'Confirm Password field is required', 
        //     'password_confirmation.string'     => 'Enter valid Confirm Password'
        // ]; 
        // $validator = Validator::make($params, $rules, $messages);
        
        // if($validator->fails()){
        //     return response()->json([
        //         'status' => 500,
        //         'message' => Arr::flatten($validator->errors()->toArray())[0], // First error message
        //         'errors'  => $validator->errors(), // All error messages
        //     ]);
        // } 
        // if ($params['password'] != $params['password_confirmation']){
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'Confirm Password does not match'
        //     ]);
        // }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->string('password')),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        // return response()->json(['status' => __($status)]);
        
        return response()->json(['status' => __($status)]);


        // $token = $request->header('Authorization');
        // $token = str_replace('Bearer ', '', $token);

        // if (!$token) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'Token does not exist'
        //     ]);
        // }
        // $session = DB::table('sessions')
        //     ->where('session_token', $token)
        //     ->where('session_status', 1) // Active sessions only
        //     ->where('session_is_delete', false)
        //     ->first();

        // if (!$session) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'Session not found'
        //     ]);
        // }
        // $user_id = $session->user_id;
        // $user = User::get_user_by_id($user_id);
        // if (!$user) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'User not found.',
        //     ]);
        // }
        
        // if (!Hash::check($params['old_password'], $user->user_password)) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'Please provide valid password!',
        //     ]);
        // }
        // $sweetword = $user->user_sweetword ? json_decode($user->user_sweetword, true) : [];

        // $sweetword[] = $params['password'];
        // $sweetword = array_unique($sweetword);
       
        // $user->user_password        = Hash::Make($request->password); 
        // $user->sweetword        = $sweetword;
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Password has been successfully reset.',
        // ]);
    }
}

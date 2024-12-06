<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

use DB;
class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): JsonResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();
        

        // return response()->noContent();

        $params = $request->all();
        $rules = [   
            // 'phone_no'     => ['required','string','max:13'],  
            'password'     => ['required','string','max:255']
            ]; 
        $messages = [
            // 'phone_no.required'   => 'Phone number required',
            // 'phone_no.string'     => 'Enter valid phone number',
            'password.required'   => 'Password field is required', 
            'password.string'     => 'Enter valid Password'
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], // First error message
                'errors'  => $validator->errors(), // All error messages
            ]);
        } 
        $get_data = User::get_data_by_phone_no($params['phone_no']);
        if (empty($get_data)){
            return response()->json([
                'status' => 500,
                'message' => 'User does not exist'
            ]); 
        }
       
        if (Hash::check($params['password'],$get_data->password)) {
            $user_token=md5($get_data->id.'-'.time() );
            // $token  = $user->createToken('auth_token')->plainTextToken;
            $token = $get_data->createToken('auth_token')->plainTextToken;

            DB::table('sessions')->insert([
                'user_id' => $get_data->id,
                'session_token' => $token,
                'session_fcm_token' => $params['fcm_token'] ?? null, 
                'session_user_device' => $params['device'] ?? null,
                'session_expiry_time_stamp' => time() + (60 * 60 * 24 * 7), 
                'session_status' => 1, 
                'session_is_delete' => false,
                'payload' => json_encode($request->all),
                'last_activity'=>time()
            ]);
           
            return response()->json([
                'status' => 200,
                'message' => 'Login successful!',
                'user' => $get_data,
                'token' => $token,
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Please provide a valid password'
            ]);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        // dd("here");
        // Auth::guard('web')->logout();
        // Auth::guard('sanctum')->user()->tokens->each(function ($token) {
        //     $token->delete();
        // });
    

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return response()->noContent();
        $params = $request->all();
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (!$token) {
            return response()->json([
                'status' => 500,
                'message' => 'Token does not exist'
            ]);
        }
        $session = DB::table('sessions')
            ->where('session_token', $token)
            ->where('session_status', 1) // Active sessions only
            ->where('session_is_delete', false)
            ->first();

        if (!$session) {
            return response()->json([
                'status' => 500,
                'message' => 'Session not found'
            ]);
        }
        // Auth::guard('sanctum')->logout();
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User logout successfully'
        ]);
    }
}

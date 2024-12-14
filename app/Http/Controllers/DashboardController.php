<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use GuzzleHttp\Client;
use \Firebase\JWT\JWT;
use App\Models\Settings;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function create(Request $request){

        return view('index');
    }


    // function getAccessToken()
    // {

    //     // Path to the service account key file
    //     $keyPath = storage_path('firebase-cred.json'); // Ensure this path is correct

    //     $factory = (new Factory)->withServiceAccount($keyPath);
    //     $googleAuthToken = $factory->createAuth()->getAccessToken();

    //     return [
    //         'token' => $googleAuthToken->getValue(),
    //         'expiry' => $googleAuthToken->getExpiresAt()->format('Y-m-d H:i:s')
    //     ];
    // }

    function getAccessToken()
    {
        $keyPath        = public_path('json/firebase_key_value_pair.json'); 
        $serviceAccount = json_decode(file_get_contents($keyPath), true);

        
        $now = time();
        $expirationTime = $now + 3600; // The token expires in 1 hour (3600 seconds)

        // Create the JWT
        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT'
        ];

        $claimSet = [
            'iss'   => $serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'iat'   => $now,
            'exp'   => $expirationTime
        ];

        // Generate JWT (you can use the Firebase JWT library for this)
        $jwt = \Firebase\JWT\JWT::encode($claimSet, $serviceAccount['private_key'], 'RS256');
        
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]);
        if (!$response->successful()) {
            throw new Exception('Failed to fetch access token: ' . $response->body());
        }
        $data = $response->json();

        return [
            'jwt' => $data['access_token'],
            'exp' => $data['expires_in'] + $now
        ];
    }

    function firebase_config(Request $request){
        $filePath        = public_path('js/firebase_json.js'); 
        
        if (File::exists($filePath)) {  
            dd("hee");
            return response()->file($filePath, ['Content-Type' => 'text/javascript']);
        }
         else {

            abort(404); 
        }
    }

    public function update_fcm(Request $request){
        $params = $request->all();
             
        $rules = [   
            'fcm_token'           => ['required','string']
            ]; 
        $messages = [
            'fcm_token.required'         => 'Fcm token is required.',
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $login = auth()->user();

        $user  = User::get_user_by_id($login->id);
        $user->user_fcm_token = $params['fcm_token'];
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'Fcm Token updated successfully!'
        ]); 
    }
    
    function sendFirebaseNotification($noti_data)
    {

        $settings = Settings::where('setting_name','fcm_token')->first();
        if(empty($settings)){
            $accessToken = $this->getAccessToken();
            $settings->setting_value  = $accessToken['jwt'];
            $settings->setting_expired = $accessToken['exp'];
        }else{
            $expiry      = $settings->setting_expired;
            $currentTime = Carbon::now()->timestamp;

            if ($currentTime > $expiry) {
                $accessToken = $this->getAccessToken();
                $settings->setting_value = $accessToken['jwt'];
                $settings->setting_expired = $accessToken['exp'];
                $settings->save();
            }else{
                $accessToken['jwt'] =$settings->setting_value; 
            }
        }
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken['jwt'],
            'Content-Type' => 'application/json',
        ];

        $url = "https://fcm.googleapis.com/v1/projects/orderapp-bc2f6/messages:send";

        $payload = [
            "message" => [
                "token" => $noti_data['fcm_token'],
                "notification" => [
                    "title" => $noti_data['title'],
                    "body" => $noti_data['body'],

                    ]
            ]
        ];
        \Log::info(['User Notified'=>$payload,'From'=>$accessToken['jwt']]);
        $response = Http::withHeaders($headers)->post($url, $payload);
        if ($response->failed()) {
            \Log::error('FCM Notification Failed', [
                'response_status' => $response->status(),
                'response_body' => $response->body(),
            ]);
        }
        \Log::info(['FCM Response' => $response->body()]);

        if ($response->successful()) {
            dd("if",$response->json());
            return $response->json();
        } else {
            dd("else",$response->json());

            return [
                'error' => $response->status(),
                'message' => $response->body()
            ];
        }
    }
    
}

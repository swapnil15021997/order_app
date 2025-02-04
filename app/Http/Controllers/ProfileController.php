<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Branch;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
            // $request->user()->email_verified_at = null;
        // }


        $request->user()->save();

        return Redirect::route('settings')->with('status', 'profile-updated');
    }

    public function user_update(Request $request){
        $params = $request->all();
       
        $rules = [   

            'user_file'        => ['required','file', 'mimes:jpeg,jpg,png,pdf,mp3,wav,ogg,webm', 'max:20240'],  
            'user_id'          => ['required','string'],
            
        ]; 
        $messages = [
            'user_file.file'     => 'Each item file image must be a valid file.',
            'user_file.mimes'    => 'Each item file image must be a jpeg, jpg, png, or pdf file,mp3, wav, or ogg file.',
            'user_file.max'      => 'Each item file image cannot exceed 10MB.',            
            'user_id.string'     => 'Notes Type must be string.',
            'user_id.required'   => 'Notes Type required.',
    
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $user = User::find($params['user_id'])->first();
        if(empty($user)){
            return response()->json([
                'status'  => 500,
                'message' => 'User does not exist' 
            ]);
        }
        if ($request->hasFile('user_file')) {
            $file = $request->file('user_file');
            $fileName = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('profiles', $fileName, 'public');
            $user->user_profile = $filePath;
            $user->save();
            session(['profile_path'     => $filePath]);
    
            return response()->json([
                'status' => 200,
                'message' => 'User Profile updated successfully.',
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'User updated successfully. No profile picture uploaded.',
            ]);
        }
        
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function save_mmc(Request $request)
    {
        $params = $request->all(); 
        $rules = [   
            'item'              => ['required','string','in:metals,colors,melting'],
            'item_id'           => ['nullable','integer'],  
            'item_value'        => ['required','string',] 

        ]; 
        $validator = Validator::make($params, $rules, []);
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $table = $params['item']; 
        $key=$column ='';
        if ($table=='metals') {
            $key='metal_id';
            $column='metal_name';
        }
        if ($table=='melting') {
            $key='melting_id';
            $column='melting_name';
        }
        if ($table=='colors') {
            $key='color_id';
            $column='color_name';
        }
        if (!empty($params['item_id'])) {
            \DB::table($table)->where($key,$params['item_id'])->update([
                $column=>$params['item_value']
            ]);
        }else{
            \DB::table($table)->insert([
                $column=>$params['item_value']
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Item saved successfully' 
        ]); 
    }
    public function delete_mmc(Request $request)
    {
        $params = $request->all(); 
        $rules = [   
            'item'              => ['required','string','in:metals,colors,melting'],
            'item_id'           => ['required','integer'],  

        ]; 
        $validator = Validator::make($params, $rules, []);
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $table = $params['item']; 
        $key=$column ='';
        if ($table=='metals') {
            $key='metal_id'; 
        }
        if ($table=='melting') {
            $key='melting_id'; 
        }
        if ($table=='colors') {
            $key='color_id'; 
        }
         
        \DB::table($table)->where($key,$params['item_id'])->update([
            'is_delete'=>1
        ]);
         
        return response()->json([
            'status' => 200,
            'message' => 'Item removed successfully' 
        ]); 
    }


    public function get_settings(Request $request) {
        
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
        }

        $activePage = 'profile';
        $branch       = Branch::get_all_branch();
        $settings = Settings::all()->filter(function ($setting) {
            return $setting->setting_name !== 'fcm_token';
        })->toArray();
        $user_permissions = session('combined_permissions', []);
        
        $metals = \DB::table('metals')->pluck('metal_name')->implode(',');
        $melting = \DB::table('melting')->pluck('melting_name')->implode(',');
        $colors = \DB::table('colors')->pluck('color_name')->implode(',');

        $metal_list     = \DB::table('metals')->where('is_delete',0)->get()->toArray();
        $melting_list   = \DB::table('melting')->where('is_delete',0)->get()->toArray();
        $color_list     = \DB::table('colors')->where('is_delete',0)->get()->toArray();


        // dd($metal_list);
       
        return view('profile.setting', [
            'user' => $request->user(),
            'login' => $login,
            'activePage' => $activePage,
            'pageTitle'=>'User Profile',    
            'branch'=>$branch,
            'user_branch' => $users_branch,
            'settings' => $settings,
            'user_permissions' => $user_permissions,
            'metals' => $metals,
            'melting'=> $melting,
            'colors' => $colors,

            'metal_list'    =>  $metal_list,
            'melting_list'  =>  $melting_list,
            'color_list'    =>  $color_list,
        ]);
    
    }
}

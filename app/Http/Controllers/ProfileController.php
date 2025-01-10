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
      
       
        return view('profile.setting', [
            'user' => $request->user(),
            'login' => $login,
            'activePage' => $activePage,
            'pageTitle'=>'User Profile',    
            'branch'=>$branch,
            'user_branch' => $users_branch,
            'settings' => $settings,
            'user_permissions' => $user_permissions

        ]);
    
    }
}

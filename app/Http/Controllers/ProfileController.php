<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Branch;
use App\Models\Settings;

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
                // branch array of user
                $users_branch  = Branch::get_users_branch($userBranchIds);
                
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
            'branch'=>$branch,
            'user_branch' => $users_branch,
            'settings' => $settings,
            'user_permissions' => $user_permissions

        ]);
    
    }
}

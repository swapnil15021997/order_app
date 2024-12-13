<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Branch;

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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
            $userBranchIds = explode(',', $login['user_branch_ids']);
        }

        $activePage = 'profile';
        $branch       = Branch::get_all_branch();
        $user_branch  = Branch::whereIn('branch_id', $userBranchIds)->get()->toArray();


        return view('profile.setting', [
            'user' => $request->user(),
            'login' => $login,
            'activePage' => $activePage,
            'branch'=>$branch,
            'user_branch' => $user_branch

        ]);
    
    }
}

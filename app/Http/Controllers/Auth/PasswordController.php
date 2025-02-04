<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        
        try{

            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
            $request->user()->update([
                'password' => Hash::make($validated['password']),
                'user_sweetword'=>$validated['password'],
            ]);
            return back()->with('status', 'password-updated');
        }
        catch(\Exception $e) {
            \Log::error('Error updating password: ' . $e->getMessage());
            return back()->withErrors(['error'=>'Failed to update password. '.$e->getMessage()]);

        }        

        
    }
}

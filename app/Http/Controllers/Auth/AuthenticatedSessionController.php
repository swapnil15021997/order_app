<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        

        
        $data = $request->all();
        $get_data = User::get_data_by_email($data['email']);
         
        if (!$get_data){
            // dd("ehk");
            \Log::info("User not found: redirecting to login");
      
            return redirect()->route('login')->withErrors(['email' => 'Please register first'])->withInput();
        }
        \Log::info(['Before Session Regeneration'=> session()->getId()]);

        $request->authenticate();
        $request->session()->regenerate();
        \Log::info(['Session Regenerated' => session()->getId()]);

        // $sessionId = session()->getId();

        // return redirect()->intended(route('dashboard', absolute: false));
        \Log::info("dawda");
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'Successfully logged out'
        // ]);
    }
}

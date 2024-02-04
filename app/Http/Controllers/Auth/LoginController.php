<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return $this->redirectTo = route('dashboard.index');
        }
        if (auth()->user()->role == 'provider') {
            $user_id = auth()->user()->id;

            $provider = Provider::withTrashed()->where('user_id', $user_id)->first();

            if ($provider != null) {
                Auth::logout();
                return $this->redirectTo = abort(403, 'Account has been removed. Please contact administrator.');
            }

            return $this->redirectTo = route('dashboard-provider');
        }
    }
}

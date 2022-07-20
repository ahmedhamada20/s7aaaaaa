<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers{
        logout as protected originallogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }


    public function redirectTo()
    {
        if (auth()->user()->roles()->first()->allowed_route != '') {
            return $this->redirectTo = 'admins/dashboard';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $cart = collect($request->session()->get('cart'));
        $response = $this->originallogout($request);
        if (!config('cart.destroy_on_logout')) {
           $cart->each(function ($rows,$identfire)use($request){
                $request->session()->put('cart.'.$identfire,$rows);
           });
        }

        return $response;
    }
}

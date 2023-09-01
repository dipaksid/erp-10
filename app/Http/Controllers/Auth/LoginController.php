<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Login loginType to be used by the controller.
     *
     * @var string
     */
    protected $loginType;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->loginType = 'email';
        $this->username = $this->findUsername();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('email');
        $this->loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$this->loginType => $login]);

        return $this->loginType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only($this->loginType, 'password'))) {
            $login_date = !Auth::user()->hasPermissionTo("ALLOW CHANGE DATE") ? date("d/m/Y") : $request->input('login_date');
            $request->session()->put('login_date', $login_date );

            return redirect()->route('home')->withSuccess('You are successfully logged in.');;
        }

        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }
}

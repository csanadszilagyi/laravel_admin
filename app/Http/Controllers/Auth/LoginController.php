<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\User;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

        /**
     * Show the application's login form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        if(Auth::check())
        {
            return redirect()->route('dashboard');
        }
       /*
        if ($this->hasTooManyLoginAttempts($request)) 
        {
           $this->sendCaptchaResponse($request);
        }
        */
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $validator = $this->getValidation($request); 
        $validator->validate();
        //$user = User::getByUsername($request->input('username'));
        //if (!empty($user)) {
            if ($this->attemptLogin($request)) {
                $request->session()->forget('loginAttempts');
                $request->session(['user_login_time' => Carbon::now()]);
                return $this->sendLoginResponse($request);
            }
            $this->incrementLoginAttempts($request);
            if ($this->hasTooManyLoginAttempts($request)) {
                    $validator->errors()->add('tooManyAttempts', '1');
                    //$this->sendCaptchaResponse($request);
            }
       // }
       
        $validator->errors()->add('generalMessage', trans('auth.failed'));
        return redirect('login')
                        ->withErrors($validator)
                        ->withInput();

        //return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

        /**
     * Get the validation by the request
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    protected function getValidation(Request $request)
    {
        $toBeValidated =  [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ];

        if($request->has('captcha'))
        {
            $toBeValidated['captcha'] = 'required|captcha';
        }
        
        return Validator::make($request->all(), $toBeValidated);    
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendCaptchaResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'tooManyAttempts' => 1,
        ])->status(429);
    }

        /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        $attempts = intval($request->session()->get('loginAttempts', 0));
        return $attempts > 3;
    }

        /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementLoginAttempts(Request $request)
    {
        $attempts = intval($request->session()->get('loginAttempts'));
        $attempts += 1;
        $request->session()->put('loginAttempts', $attempts);
    }

    /**
     * Gets the property of user to be identified by.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

}

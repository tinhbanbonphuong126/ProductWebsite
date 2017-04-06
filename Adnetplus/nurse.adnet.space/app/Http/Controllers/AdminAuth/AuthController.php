<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Staff;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    // you can put whatever column you want here from your users/auth table
    protected $username = 'code';

    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        if (Auth::guard($this->guard)->check()) {
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // validate input data
        $validator = Validator::make($request->all(), array(
            'code' => 'required|min:2',
            'password' => 'required|min:2'
        ));
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('admin.auth.login', compact('errors'));
        }

        // authenticate the user
        $credentials = [
            'code' => $request->get('code'),
            'password' => $request->get('password'),
            'is_admin' => true,
            'delete_flag' => 0
        ];
        if (Auth::guard($this->guard)->attempt($credentials)) {
            $user = Auth::guard($this->guard)->user();
            $request->session()->put('user', $user);
            return redirect('/admin');
        } else {
            $errors = ['message' => 'IDまたはPASSが間違っています'];
            return view('admin.auth.login', compact('errors'));
        }
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
        //request()->session()->flush();
        Session::flush();
        return redirect('/admin/login');
    }

    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function resetPassword()
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Staff
     */
    protected function create(array $data)
    {
        return Staff::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}

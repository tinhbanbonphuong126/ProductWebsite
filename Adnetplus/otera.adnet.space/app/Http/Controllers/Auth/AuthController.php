<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * show form login for user and admin
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin(){
        if (\Auth::check())
        {
            $user = \Auth::user();
            if($user->role == 1){
                // link to admin
                return \Redirect::to('/admin/users');
            }else{
                // return link for user
                return \Redirect::to('/staff/staffrequest');
            }
        }
        return view('login.user');
    }
   public function staffLogin(){
       if (\Auth::check())
       {
           $user = \Auth::user();
           if($user->role == 0){
               // link to admin
               return \Redirect::to('/staff/staffrequest');
           }else{
               // return link for user
               return \Redirect::to('/admin/users');
           }
       }
       return view('login.staff');
   }
    /**
     * post login user admin and user
     *
     * @param AdminLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(AdminLoginRequest $request){
        $credentials = [
            'account_id' => $request->get('account_id'),
            'password' => $request->get('password'),
            'delflag'=> 0
        ];
        if (\Auth::attempt($credentials)) {
            $user = \Auth::user();
            if($user->role == 1){
                // link to admin
                return \Redirect::to('/admin/users');
            }else{
                return \Redirect::to('/staff/staffrequest');
            }
        }else {
            return \Redirect::back()->with('message',trans('commons.not_found_admin'));
        }
    }

    public function logout(){
        \Auth::logout();
        return \Redirect::to('/auth/login');
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function checkUserAdmin(){
        if(Input::get('account_id') == \Config::get('setting.account_id') && Input::get('password') == \Config::get('setting.password')){
            return "ok";
        }
        return "error";
    }
}

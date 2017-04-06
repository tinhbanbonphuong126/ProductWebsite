<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use App\Http\Requests\UndertakerLoginRequest;

class UndertakerController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/under/urequest/create';
    protected $guard = 'undertaker';

    public function getLogin()
    {
        if (Auth::guard('undertaker')->check())
        {
            return \Redirect::route('under.urequest.create');
        }

        return view('login.undertaker');
    }

    public function postLogin(UndertakerLoginRequest $request){
        $credentials = [
            'account_id' => $request->get('account_id'),
            'password' => $request->get('password'),
            'delflag'=> 0
        ];
        if (\Auth::guard('undertaker')->attempt($credentials)) {
            return \Redirect::route('under.urequest.create');
        }else {
            return \Redirect::back()->with('message',trans('commons.not_found_admin'));
        }
    }

    public function logout(){
        Auth::guard('undertaker')->logout();
        return \Redirect::to('/auth/login');
    }
}

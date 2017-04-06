<?php

namespace App\Controllers\Admin;

use App\System\Session;
use App\Repositories\Administrators;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * show login form
     */
    public function getLogin()
    {
        $this->setTemplate('login', 'login');
    }

    /**
     * submit login form
     */
    public function postLogin()
    {
        $code = $this->request->get('code');
        $password = $this->request->get('password');
        $administrators = new Administrators();
        $admin = $administrators->login($code, $password);
        if ($admin) {
            Session::set('login_user', $admin);
            redirect('admin/home');
        } else {
            $this->setTemplate('login', 'login', ['errors' => ['Authentication failed!']]);
        }
    }

    /**
     * logout application
     */
    public function logout()
    {
        Session::destroy();
        redirect('admin/login');
    }
}
<?php

namespace App\Controllers\Admin;

use App\System\Request;
use App\System\Response;
use App\System\Session;

class Controller
{
    protected $request;
    protected $response;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    /**
     * @param $layout
     * @param $template
     * @param array $templateVars
     */
    protected function setTemplate($layout, $template, array $templateVars = array())
    {
        ob_start();
        if ($templateVars) extract($templateVars);
        include VIEW_DIR . 'admin/' . $template . '.php';
        $view = ob_get_clean();
        if ($view) {
            $layout = strpos($layout, '.') !== false ? str_replace('.', '/', $layout) : $layout;
            include VIEW_DIR . 'admin/layout/' . $layout. '.php';
        } else {
            die('Empty view!');
        }
    }

    /**
     *
     */
    protected function checkUserLoggedIn()
    {
        if (!Session::get('login_user')) {
            redirect('admin/login');
        };
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    protected function getResponse()
    {
        return $this->response;
    }
}
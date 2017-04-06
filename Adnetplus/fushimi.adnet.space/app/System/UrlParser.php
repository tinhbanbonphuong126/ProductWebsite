<?php

namespace App\System;


class UrlParser
{
    private $requestMethod;
    private $requestUri;

    private $controller;
    private $action;

    /**
     * UrlParser constructor.
     * @param $requestMethod
     * @param $requestUri
     */
    public function __construct($requestMethod, $requestUri)
    {
        $this->requestMethod = $requestMethod;
        $this->requestUri = $this->removeEndingSlash($requestUri);
        $this->parse();
    }

    /**
     * Get action method (controller's method name)
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get controller name
     *
     * @return string
     */
    public function getController()
    {
        return '\\App\\Controllers\\' . $this->controller;
    }

    /**
     * Parse routes
     */
    private function parse()
    {
        global $routes;
        $isAdmin = strpos($this->requestUri, 'admin') !== false;
        Session::set('admin', $isAdmin);
        $urls = $routes[strtoupper($this->requestMethod)];
        if (array_key_exists($this->requestUri, $urls)) {
            $actionMapping = $urls[$this->requestUri];
            $arr = explode('@', $actionMapping);
            $this->controller = $arr[0];
            $this->action = $arr[1];
        } else {
            if ($isAdmin) {
                redirect('admin');
            } else {
                redirect('/');
            }
        }
    }

    /**
     * Remove ending slash character from request URI.
     *
     * @param $requestUri
     * @return string
     */
    private function removeEndingSlash($requestUri)
    {
        if (strlen($requestUri) > 1 && (strrpos($requestUri, '/') == strlen($requestUri) - 1)) {
            $requestUri = substr($requestUri, 0, strlen($requestUri) - 1);
        }
        return $requestUri;
    }
}
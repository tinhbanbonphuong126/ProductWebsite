<?php

namespace App\System;


class Request
{
    private $data;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    /**
     * Get a request parameter
     *
     * @param $key
     * @return mixed|string
     */
    public function get($key)
    {
        if (is_array($this->data) && array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return '';
    }

    /**
     * Check if a request parameter exists.
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Get all request paramters
     *
     * @return mixed
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Get a limited numbers of request parameters
     *
     * @param array $keys
     * @return array
     */
    public function only(array $keys)
    {
        $input = [];
        foreach ($keys as $key) {
            $input[$key] = isset($this->data[$key]) ? $this->data[$key] : '';
        }
        return $input;
    }

    /**
     * Check if the request is an AJAX request.
     *
     * @return bool
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }


    /**
     * Check request method
     *
     * @param $submitMethod A string or an array of strings, i.e: 'ajax', 'post', ['get', 'post']
     * @return bool
     */
    public function is($submitMethod)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($submitMethod) {
            if (is_array($submitMethod)) {
                foreach ($submitMethod as $method) {
                    if (strtolower($method) === 'ajax') {
                        return $this->isAjax();
                    } else {
                        if ($requestMethod === strtoupper($method)) {
                            return true;
                        }
                    }
                }
            } else {
                if (strtolower($submitMethod) === 'ajax') {
                    return $this->isAjax();
                } else {
                    return $requestMethod === strtoupper($submitMethod);
                }
            }
        } else {
            dd(__METHOD__ . ': Wrong argument!');
        }
    }
}
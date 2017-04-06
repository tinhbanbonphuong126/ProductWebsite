<?php

namespace App\System;


class Route
{

    /**
     * Route for GET request
     *
     * @param $uri
     * @param $actionMapping
     */
    public static function get($uri, $actionMapping)
    {
        global $routes;
        if (!isset($routes['GET'])) $routes['GET'] = [];
        $routes['GET'][$uri] = $actionMapping;
    }

    /**
     * Route for POST request
     *
     * @param $uri
     * @param $actionMapping
     */
    public static function post($uri, $actionMapping)
    {
        global $routes;
        if (!isset($routes['POST'])) $routes['POST'] = [];
        $routes['POST'][$uri] = $actionMapping;
    }

    /**
     * Route for PUT request
     *
     * @param $uri
     * @param $actionMapping
     */
    public static function put($uri, $actionMapping)
    {
        global $routes;
        if (!isset($routes['PUT'])) $routes['PUT'] = [];
        $routes['PUT'][$uri] = $actionMapping;
    }

    /**
     * Route for PATCH request
     *
     * @param $uri
     * @param $actionMapping
     */
    public static function patch($uri, $actionMapping)
    {
        global $routes;
        if (!isset($routes['PATCH'])) $routes['PATCH'] = [];
        $routes['PATCH'][$uri] = $actionMapping;
    }

    /**
     * Route for DELETE request
     *
     * @param $uri
     * @param $actionMapping
     */
    public static function delete($uri, $actionMapping)
    {
        global $routes;
        if (!isset($routes['DELETE'])) $routes['DELETE'] = [];
        $routes['DELETE'][$uri] = $actionMapping;
    }
}
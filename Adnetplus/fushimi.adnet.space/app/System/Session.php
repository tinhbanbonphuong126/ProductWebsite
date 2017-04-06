<?php

namespace App\System;


class Session
{
    /**
     * Set Session variable
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get Session variable
     *
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Remove Session variable
     *
     * @param $key
     */
    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy the whole session
     */
    public static function destroy()
    {
        session_destroy();
    }
}
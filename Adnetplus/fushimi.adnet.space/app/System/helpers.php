<?php

use \App\System\Session;

/**
 * @param $uri
 * @param array $params
 * @return string
 */
function url($uri, array $params = [])
{
    $url = APP_URL . $uri;
    if ($params) {
        $url .= '?';
        foreach ($params as $key => $val) {
            $url .= "$key=$val&";
        }
        $url = substr($url, 0, strlen($url) - 1);
    }
    return $url;
}


/**
 * @param $uri
 * @param array $params
 */
function redirect($uri, array $params = [])
{
    $redirectUrl = APP_URL . $uri;
    if ($params) {
        $redirectUrl .= '?';
        foreach ($params as $key => $val) {
            $redirectUrl .= "$key=$val&";
        }
        $redirectUrl = substr($redirectUrl, 0, strlen($redirectUrl) - 1);
    }
    header('Location: ' . $redirectUrl);
    exit;
}

/**
 * @param $assetFile
 * @return string
 */
function asset($assetFile)
{
    return STATIC_URL . $assetFile;
}

/**
 * @param $phpFile
 * @param array $data
 */
function partial($phpFile, array $data = array())
{
    if ($data) extract($data);
    $phpFile = strpos($phpFile, '.') !== false ? str_replace('.', '/', $phpFile) : $phpFile;
    if (isAdmin()) {
        include VIEW_DIR . 'admin/partials/' . $phpFile . '.php';
    } else {
        include VIEW_DIR . 'partials/' . $phpFile . '.php';
    }
}

/**
 * @param $phpFile
 * @param array $data
 */
function modal($phpFile, array $data = array())
{
    if ($data) extract($data);
    $phpFile = strpos($phpFile, '.') !== false ? str_replace('.', '/', $phpFile) : $phpFile;
    if (isAdmin()) {
        include VIEW_DIR . 'admin/modal/' . $phpFile . '.php';
    } else {
        include VIEW_DIR . 'modal/' . $phpFile . '.php';
    }
}

/**
 * dump and die
 */
function dd()
{
    $args = func_get_args();
    foreach ($args as $data) {
        if (is_array($data)) {
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else {
            var_dump($data);
        }
    }
    die();
}

/**
 * @param $dateVal
 * @param $originFormat
 * @param string $targetFormat
 * @return string
 */
function dateFormat($dateVal, $originFormat = '', $targetFormat = 'Y.m.d')
{
    if (empty($originFormat)) {
        $originFormat = (strlen($dateVal) == 10) ? 'Y-m-d' : 'Y-m-d H:i:s';
    }
    $dt = \DateTime::createFromFormat($originFormat, $dateVal);
    return $dt->format($targetFormat);
}

/**
 * @return null
 */
function isAdmin()
{
    return Session::get('admin');
}

/**
 * Check if the menu is active
 *
 * @param $name
 * @return bool
 */
function isActiveMenu($name)
{
    $uri = $_SERVER['REQUEST_URI'];
    return strpos($uri, $name) != false;
}

/**
 * @param array $item [key => value]
 */
function session(array $item)
{
    $key = key($item);
    $val = $item[$key];
    Session::set($key, $val);
}

/**
 * Convenience method for htmlspecialchars.
 *
 * @param string|array|object $text Text to wrap through htmlspecialchars. Also works with arrays, and objects.
 *    Arrays will be mapped and have all their elements escaped. Objects will be string cast if they
 *    implement a `__toString` method. Otherwise the class name will be used.
 * @param bool $double Encode existing html entities.
 * @param string|null $charset Character set to use when escaping. Defaults to config value in `mb_internal_encoding()`
 * or 'UTF-8'.
 * @return string Wrapped text.
 * @link http://book.cakephp.org/3.0/en/core-libraries/global-constants-and-functions.html#h
 */
function h($text, $double = true, $charset = null)
{
    if (is_string($text)) {
        //optimize for strings
    } elseif (is_array($text)) {
        $texts = [];
        foreach ($text as $k => $t) {
            $texts[$k] = h($t, $double, $charset);
        }

        return $texts;
    } elseif (is_object($text)) {
        if (method_exists($text, '__toString')) {
            $text = (string)$text;
        } else {
            $text = '(object)' . get_class($text);
        }
    } elseif (is_bool($text)) {
        return $text;
    }

    static $defaultCharset = false;
    if ($defaultCharset === false) {
        $defaultCharset = mb_internal_encoding();
        if ($defaultCharset === null) {
            $defaultCharset = 'UTF-8';
        }
    }
    if (is_string($double)) {
        $charset = $double;
    }

    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, ($charset) ? $charset : $defaultCharset, $double);
}
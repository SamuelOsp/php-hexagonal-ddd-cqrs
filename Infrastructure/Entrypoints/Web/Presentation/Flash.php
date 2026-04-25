<?php

class Flash
{
    public static function start()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function get($key, $default = null)
    {
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $value;
        }
        return $default;
    }

    public static function setOld(array $old)
    {
        self::set('old', $old);
    }

    public static function old()
    {
        return self::get('old', []);
    }

    public static function setErrors(array $errors)
    {
        self::set('errors', $errors);
    }

    public static function errors()
    {
        return self::get('errors', []);
    }

    public static function setMessage(string $message)
    {
        self::set('message', $message);
    }

    public static function message()
    {
        return (string) self::get('message', '');
    }

    public static function setSuccess(string $message)
    {
        self::set('success', $message);
    }

    public static function success()
    {
        return (string) self::get('success', '');
    }
}

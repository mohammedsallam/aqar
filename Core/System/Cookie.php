<?php

namespace System;


class Cookie
{

    /**
     * Application var
     *
     * @var Application
     */

    public $app;

    /**
     * Session constructor.
     *
     * @param Application $app
     */

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * Set cookie key
     *
     * @param string $name
     * @param string|int $value
     */

    public function set($name, $value, $expire = null)
    {
        return setcookie($name, $value, $expire, '/', $_SERVER['HTTP_HOST'], false, true);
    }

    /**
     * @param string|int $key
     * @param null $default
     * @return string|int
     */

    public function get($key, $default = null)
    {
        return array_get($_COOKIE, $key, $default);
    }

    /**
     * If session has key
     *
     * @param $key
     * @return bool
     */

    public function has($key)
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * Remove session key for the given key
     *
     * @param $key
     */

    public function remove($key)
    {
        unset($_COOKIE[$key]);
    }

    /**
     * Return all session keys and value
     *
     * @return mixed
     */

    public function all()
    {
        return $_COOKIE;
    }

    /**
     * Return session key and remove it
     *
     * @param $key
     * @return mixed
     */

    public function pull($key)
    {
        $value = $_COOKIE[$key];
        unset($_COOKIE[$key]);
        return $value;
    }

    public function destroy(){
        foreach ($this->all() as $key => $value) {
            setcookie($key, $value, time()-7200, '/', $_SERVER['HTTP_HOST'], false, true);
        }

    }


}
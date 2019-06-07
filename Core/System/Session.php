<?php

namespace System;


class Session
{

    public $sessionStartTime;

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
     * Session start
     *
     * @return void
     */

    public function start()
    {
        if (! session_id()){
            session_start();
        }
    }

    /**
     * Set session key
     *
     * @param string $key
     * @param string|int $value
     * @param int $expire
     */

    public function set($key, $value)
    {

        $_SESSION[$key] = $value;
    }

    /**
     * @param string|int $key
     * @param null $default
     * @return string|int
     */

    public function get($key, $default = null)
    {
        return array_get($_SESSION, $key, $default);
    }

    /**
     * If session has key
     *
     * @param $key
     * @return bool
     */

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove session key for the given key
     *
     * @param $key
     */

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Return all session keys and value
     *
     * @return mixed
     */

    public function all()
    {
        return $_SESSION;
    }

    /**
     * Return session key and remove it
     *
     * @param $key
     * @return mixed
     */

    public function pull($key)
    {
        $value = $_SESSION[$key];
        session_destroy();
        return $value;
    }

    /**
     * Session destroy
     *
     * @return void
     */

    public function destroy()
    {
        session_destroy();
    }

}
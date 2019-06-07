<?php

namespace System;


class Request
{

    /**
     * Application
     *
     * @var Application
     */

    public $app;

    /**
     * Url posts/post-title/1212
     *
     * @var $url
     */

    private $url;

    /**
     * Base url http://localhost/mvc_art
     *
     * @var $baseUrl
     */

    private $baseUrl;


    /**
     * Request constructor.
     *
     * @param Application $app
     */

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Prepare url
     */

    public function prepareUrl()
    {
        $scriptName = dirname($this->server('SCRIPT_NAME'));

        $requestUrl = $this->server('REQUEST_URI');

        if (strpos($requestUrl, '?') !== false){
            list($requestUrl, $query) = explode('?', $requestUrl);
        }

        $this->url = str_replace($scriptName, '', $requestUrl);

        $this->baseUrl = $this->server('REQUEST_SCHEME').'://'.$this->server('SERVER_NAME').$scriptName.'/';

    }


    /**
     * @param $key
     * @param null $default
     * @return null
     */

    public function get($key, $default = null)
    {
        return array_get($_GET, $key, $default);
    }


    /**
     * @param $key
     * @param null $default
     * @return null
     */

    public function post($key, $default = null)
    {
        return array_get($_POST, $key, $default);
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */

    public function server($key, $default = null)
    {
        return array_get($_SERVER, $key, $default);
    }

    /**
     * @return null
     */

    public function requestMethod()
    {
       return $this->server('REQUEST_METHOD');
    }

    public function all($method)
    {
        if ($method == 'post'){
            return $_POST;
        } else {
            return $_GET;
        }
    }

    /**
     * @return mixed
     */

    public function baseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return mixed
     */

    public function url()
    {
        return $this->url;
    }

}
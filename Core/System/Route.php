<?php
namespace System;

class Route
{

    /**
     * Application var
     *
     * @var Application
     */

    public $app;

    public $baseUrl;

    /**
     * admin controller
     */

    public static $url;


    /**
     *  Controllers namespace
     */

    const CONTROLLERS_NAMESPACE = 'Controllers\\';

    /**
     * Route constructor.
     * @param Application $app
     */

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * Parse url to get controller and call method and pass args
     *
     * @return void
     */

    public function prepareUrl()
    {

        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 4);

        array_shift($url);

        if (isset($url[0]) && $url[0] !== ''){
            $this->app->controller = $url[0];
        }


        if (isset($url[1]) && $url[1] !== ''){
            $this->app->action = $url[1];
        }

        if (isset($url[2]) && $url[2] !== ''){
            $this->app->params = $url[2];
        }

    }

    /**
     * Load controller and call method
     *
     * @return void
     */

    public function dispatch()
    {

        $controller = static::CONTROLLERS_NAMESPACE . ucfirst($this->app->controller) . 'Controller';


        $controller = str_replace(['-', '_'], ['', ''], $controller);

        $action = $this->app->action;


        if (! class_exists($controller)){
            $controller = Application::NOT_FOUND_CONTROLLER;
        }

        $object = new $controller($this->app);

        if (! method_exists($object, $action)){
            $action =  Application::NOT_FOUND_SITE_ACTION;
        }


        $object->$action();

    }


    /**
     * Generate base url
     *
     * @return array|string
     */

    public function baseUrl()
    {
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        $this->baseUrl = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$scriptName.'/';
        return $this->baseUrl;
    }


    /**
     * Get Application properties directly
     *
     * @param $name
     * @return mixed
     */


    public function __get($name)
    {
        return $this->app->$name;
    }


}
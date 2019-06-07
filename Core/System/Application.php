<?php
namespace System;

class Application
{

    /**
     * @var $instance
     */

    public static $instance;


    /**
     * Container
     *
     * @var array
     */

    public $container = [];


    /**
     * Default controller
     *
     * @var string $controller
     */

    public $controller = 'index';

    /**
     * Default action
     *
     * @var string $action
     */

    public $action = 'home';

    /**
     * Parameters
     *
     * @var array $params
     */

    public $params = [];


    const NOT_FOUND_CONTROLLER = 'Controllers\\NotFoundController';

    const NOT_FOUND_ADMIN_ACTION = 'notFoundAdmin';

    const NOT_FOUND_SITE_ACTION = 'notFoundSite';

    const ADMIN = 'admin';

    private function __construct()
    {
        $this->load();
    }

    /**
     * Run the application
     *
     * @return  void
     */

    public function run()
    {
        $this->session->start();
        $this->route->prepareUrl();
        $this->route->dispatch();
    }


    /**
     * Get application instance
     *
     * @return Application
     */

    public static function getInstance()
    {
        if (self::$instance === null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Auto load files and classes
     *
     * @param $class
     */

    private function autoLoadClasses($class)
    {
        $file = '';
        if (strpos($class, 'Controllers') === 0){
            $file = APP_PATH . str_replace('\\', DS, $class) . '.php';
        } elseif (strpos($class, 'Models') === 0) {
            $file = APP_PATH . str_replace('\\', DS, $class) . '.php';
        } elseif (strpos($class, 'System') === 0) {
            $file = CORE_PATH . str_replace('\\', DS, $class) . '.php';
        }

        if (file_exists($file)){
            require_once $file;
        }

    }

    /**
     * auto load classes by spl_spl_autoload_register
     *
     * @return void;
     */

    private function load()
    {
        spl_autoload_register([$this, 'autoLoadClasses']);
    }

    /**
     * Check if the given key isset in core classes
     *
     * @param string $key
     * @return bool
     */

    public function isCoreClass($key)
    {
        $class = $this->coreClasses();
        return isset($class[$key]);
    }

    /**
     * Core classes
     *
     * @return array
     */

    public function coreClasses()
    {
        return [
            'session'       => 'System\Session',
            'cookie'        => 'System\Cookie',
            'adminTemp'     => 'System\AdminTemplate',
            'siteTemp'     => 'System\SiteTemplate',
            'filter'        => 'System\Filter',
            'request'       => 'System\Request',
            'route'         => 'System\Route',
            'db'            => 'System\Database',
            'format'            => 'System\EmailFormat',
            'mail'          => 'System\PHPMailer\PHPMailer',
            'exception'          => 'System\PHPMailer\Exception'
        ];
    }

    /**
     * share key and value inside container
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */

    public function share($key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     * Check if key exist in container or not
     *
     * @param string $key
     * @return bool
     */

    public function isShare($key)
    {
        return isset($this->container[$key]);
    }

    /**
     * Create new object for the given key
     *
     * @param string $key
     * @return object
     */

    public function createNewObject($key)
    {
        $class = $this->coreClasses();
        $object = $class[$key];
        return new $object($this);
    }

    /**
     * Get the key from container
     *
     * @param string $key
     * @return mixed
     */

    public function get($key)
    {
        if (! $this->isShare($key)){
            if ($this->isCoreClass($key)){
               $this->share($key, $this->createNewObject($key));
            } else {
                die('Class <b>' . $key . '</b> Not found');
            }
        }

        return $this->container[$key];
    }


    /**
     * Call container key dynamically
     *
     * @param string $key
     * @return mixed
     */

    public function __get($key)
    {
        return $this->get($key);
    }
}
<?php
namespace System;

class SiteTemplate
{
    /**
     * Application
     * @var Application
     */

    public $app;

    /**
     * Loader constructor.
     *
     * @param Application $app
     */

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * Load head lay out
     *
     * @return void
     */

    public function loadHeadStart()
    {
        $file = SITE_TEMPLATE_PATH . 'head_start.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Css resources
     *
     * @return array
     */

    public function cssResources()
    {
       return [
           'bootstrap' => $this->route->baseUrl() . SITE_CSS .'bootstrap.min.css',
           'fa' => $this->route->baseUrl() . SITE_CSS .'font-awesome.min.css',
//           'mat' => $this->route->baseUrl() . SITE_CSS .'materialize.css',
//           'owl' => $this->route->baseUrl() . SITE_CSS .'owl.carousel.min.css',
//           'owl_them' => $this->route->baseUrl() . SITE_CSS .'owl.theme.default.min.css',
//           'mat_icon' => $this->route->baseUrl() . SITE_CSS .'material_icon.css',
           'select2' => $this->route->baseUrl() . SITE_CSS .'select2.min.css',
//           'lightbox' => $this->route->baseUrl() . SITE_CSS .'lightbox.min.css',
//           'nivo'          => $this->route->baseUrl() . SITE_CSS . 'nivo-lightbox.css',
           'pgwslider'          => $this->route->baseUrl() . SITE_CSS . 'pgwslider.min.css',
           'style' => $this->route->baseUrl() . SITE_CSS .'style.css',

       ];
    }


    /**
     * Load css resources
     *
     * @return void
     */

    public function loadCssResources()
    {

//        if ($this->app->controller == Application::NOT_FOUND_CONTROLLER){
//
//            $class = Application::NOT_FOUND_CONTROLLER;
//        } else {
//            $class = Route::CONTROLLERS_NAMESPACE . ucfirst($this->app->controller) . 'Controller';
//        }
//
//        $class = new $class($this->app);
        $cssResources = $this->cssResources();

        if (property_exists(get_called_class(), 'loadCss')){
            for ($i = 0; $i < count($this->loadCss); $i++){
                if (array_key_exists($this->loadCss[$i], $cssResources)){ ?>
                    <link rel="stylesheet" href="<?= $cssResources[$this->loadCss[$i]] ?>">
                <?php }
            }
        } else {
            foreach ($cssResources as $key => $value) { ?>
                <link rel="stylesheet" href="<?= $value ?>">
            <?php }
        }

    }

    /**
     * Load head end
     *
     * @return  void
     */

    public function loadHeadEnd()
    {
        $file = SITE_TEMPLATE_PATH . 'head_end.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Load body end
     *
     * @return  void
     */

    public function bodyStart()
    {
        $file = SITE_TEMPLATE_PATH . 'body_start.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Load loader end
     *
     * @return  void
     */

    public function loader()
    {
        $file = SITE_TEMPLATE_PATH . 'loader.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Load overlay end
     *
     * @return  void
     */

    public function overlay()
    {
        $file = SITE_TEMPLATE_PATH . 'overlay.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function navBar()
    {
        $file = SITE_TEMPLATE_PATH . 'navbar.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }

    /**
     * Load top nav end
     *
     * @return  void
     */

    public function slider()
    {
        $file = SITE_TEMPLATE_PATH . 'slider.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }

    /**
     * Load content start end
     *
     * @return  void
     */

    public function contentStart()
    {
        $file = SITE_TEMPLATE_PATH . 'content_start.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }




    public function footerSection()
    {
        $file = SITE_TEMPLATE_PATH . 'footer.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }

    /**
     * Load content end end
     *
     * @return  void
     */

    public function contentEnd()
    {
        $file = SITE_TEMPLATE_PATH . 'content_end.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Js resources
     *
     * @return array
     */

    public function jsResources()
    {
        return [
            'jquery'    => $this->route->baseUrl() . SITE_JS . 'jquery-3.2.1.min.js',
            'bootstrap' => $this->route->baseUrl() . SITE_JS . 'bootstrap.min.js',
//            'materialize' => $this->route->baseUrl() . SITE_JS . 'materialize.min.js',
//            'owl' => $this->route->baseUrl() . SITE_JS . 'owl.carousel.min.js',
//            'validation' => $this->route->baseUrl() . SITE_JS . 'jqBootstrapValidation.js',
//            'contact' => $this->route->baseUrl() . SITE_JS . 'contact_me.js',
            'select2'      => $this->route->baseUrl() . SITE_JS . 'select2.min.js',
//            'lightbox'      => $this->route->baseUrl() . SITE_JS . 'lightbox.min.js',
//            'nivo'      => $this->route->baseUrl() . SITE_JS . 'nivo-lightbox.min.js',
            'pgwslider'      => $this->route->baseUrl() . SITE_JS . 'pgwslider.min.js',
            'main'      => $this->route->baseUrl() . SITE_JS . 'main.js'


        ];
    }


    /**
     * Load js resources
     *
     * @return void
     */

    public function loadJsResources()
    {

//        if ($this->app->controller == Application::NOT_FOUND_CONTROLLER){
//
//            $class = Application::NOT_FOUND_CONTROLLER;
//        } else {
//            $class = Route::CONTROLLERS_NAMESPACE . ucfirst($this->app->controller) . 'Controller';
//        }
//
//        $class = new $class($this->app);

        $jsResources = $this->jsResources();

        if (property_exists(get_called_class(), 'loadJs')){
            for ($i = 0; $i < count($this->loadJs); $i++){
                if (array_key_exists($this->loadJs[$i], $jsResources)){ ?>
                    <script src="<?= $jsResources[$this->loadJs[$i]] ?>"></script>
                <?php }
            }
        } else {

            foreach ($jsResources as $key => $value) { ?>
                <script src="<?= $value ?>"></script>
            <?php }

        }
    }


    /**
     * Load footer
     *
     * @return void
     */

    public function loadBodyEnd()
    {
        $file = SITE_TEMPLATE_PATH . 'body_end.php';

        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function __get($name)
    {
        return $this->app->$name;
    }

}
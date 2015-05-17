<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $_defaultPage = DEFAULT_PAGE;

    function __construct() {
        //Sets the protected $_url
        $this->_getUrl();

        //Load the default controller if no URL is set
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        $this->loadExistingController();

        $this->callControllerMethod();


    }

    /**
     * Fetches the $GET from 'url'
     */
    private function _getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }

    /**
     * This loads if no GET parameter passed
     */
    private function _loadDefaultController() {
        require 'controllers/' . $this->_defaultPage . '.php';
        $this->_controller = new  $this->_defaultPage();
        $this->_controller->index();
        $this->_controller->loadModel($this->_defaultPage);
    }

    /**
     * Load an existing controller if there is a GET parameter passed
     * @return boolean | string
     */
    private function loadExistingController() {
        $file = 'controllers/' . $this->_url[0] . '.php';
        if (file_exists($file)) {
            require 'controllers/' . $this->_url[0] . '.php';
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0]);
        } else {
            $this->_error();
            return false;
        }
    }

    /**
     * If a method is passed in the GET url parameter
     */
    private function callControllerMethod() {
        /**
         * http://a.com/controller/method/(parameter)
         * $_url[0] = controller
         * $_url[1] = method
         * $_url[2] = parameter
         */

        //calling methods
        if (isset($this->_url[2])) {
            if (method_exists($this->_controller, $this->_url[1])) {
                $this->_controller->{$this->_url[1]}($this->_url[2]);
            } else {
                $this->_error();
                return false;
            }
        } else {
            if (isset($this->_url[1])) {
                if (method_exists($this->_controller, $this->_url[1])) {
                    $this->_controller->{$this->_url[1]}();
                } else {
                    $this->_error();
                    return false;
                }
            } else {
                $this->_controller->index();
            }

        }
    }

    /**
     * Display an error page if nothing exists
     * @return boolean
     */
    private function _error() {
        require 'controllers/error.php';
        $this->_controller = new Error();
        $this->_controller->index();
        //return false;
        exit;
    }
}
<?php

class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameter one */
    private $url_parameter_1 = null;

    /** @var null Parameter two */
    private $url_parameter_2 = null;

    /** @var null Parameter three */
    private $url_parameter_3 = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        $this->loadSecureSession();

        // check for controller: does such a controller exist ?
        if (file_exists(CONTROLLER_PATH . $this->url_controller . '.php')) {

            // if so, then load this file and create this controller
            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {
                // if the current visiter has the permission to load this page
                if ($this->permissionCheck($this->url_controller, $this->url_action))
                {
                    $this->url_controller = new $this->url_controller();
                    $this->routeControllerAndAction();
                    return;
                }
            } 
        } 

        // invalid URL or permission deny, so simply show home/index
        $this->jumpToHomePage();
    }

    private function jumpToHomePage()
    {
        header("LOCATION: ".URL."home/index");
        $home = new HomeController();
        $home->index();
    }


    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_controller = ucfirst($this->url_controller) . 'Controller';
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
        }
    }

    private function routeControllerAndAction()
    {
        // call the method and pass the arguments to it
        if (isset($this->url_parameter_3)) {
            // will translate to something like $this->home->method($param_1, $param_2, $param_3);
            $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
        } elseif (isset($this->url_parameter_2)) {
            // will translate to something like $this->home->method($param_1, $param_2);
            $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
        } elseif (isset($this->url_parameter_1)) {
            // will translate to something like $this->home->method($param_1);
            $this->url_controller->{$this->url_action}($this->url_parameter_1);
        } else {
            // if no parameters given, just call the method without parameters, like $this->home->method();
            $this->url_controller->{$this->url_action}();
        }
    }

    private function loadSecureSession()
    {
        SecureSessionService::sec_session_start();
    }


    private function permissionCheck($controller, $action)
    {
        $permissionList = $controller::accessRules();
        if (in_array($action, $permissionList[ALLOW_FROM_ALL]))
        {
            return True;
        }
        else if(in_array($action, $permissionList[ALLOW_FROM_LOGIN]))
        {
            if (AuthService::isLogin())
            {
                return True;
            }
        }
        return False;
    }
}

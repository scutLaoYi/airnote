<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    public static function accessRules()
    {
       return array(
              ALLOW_FROM_ALL => array(),
              ALLOW_FROM_LOGIN => array(),
              );
    }

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
        $this->loadUserStatus();
    }

    private function loadUserStatus()
    {
        if ($username = AuthService::isLogin())
        {
            $this->username = $username;
        }
    }

    /**
      * Just a function to render the default web page layout.
      */
    public function render($view_name, $header_name = 'header.php', $footer_name = 'footer.php')
    {
        require_once TEMPLATE_PATH . $header_name;
        require_once VIEW_PATH . $view_name;
        require_once TEMPLATE_PATH . $footer_name;
    }

    public function safeText($user_input)
    {
        $user_input = trim($user_input);
        $user_input = stripslashes($user_input);
        $user_input = htmlspecialchars($user_input);
        return $user_input;
    }

    public function raiseInfo($info)
    {
        $this->_info_to_show = $info;
    }

    public function raiseAlert($alert)
    {
        $this->_alert_to_show = $alert;
    }
}

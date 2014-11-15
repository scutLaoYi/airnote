<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

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
        $this->openDatabaseConnection();
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
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    /**
     * Load the model with the given name.
     * loadModel("SongModel") would include models/songmodel.php and create the object in the controller, like this:
     * $songs_model = $this->loadModel('SongsModel');
     * Note that the model class name is written in "CamelCase", the model's filename is the same in lowercase letters
     * @param string $model_name The name of the model
     * @return object model
     */
    public function loadModel($model_name)
    {
        require_once MODEL_PATH . strtolower($model_name) . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db);
    }

    public function loadService($service_name)
    {
        require_once SERVICE_PATH.strtolower($service_name).'.php';
        return;
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

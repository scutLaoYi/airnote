<?php

class User extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->loadService('auth');
        $this->auth = new AuthService($this->db);
    }

    public function login()
    {
        $this->title="Login";
        $user_ip = $_SERVER['REMOTE_ADDR'];

        if(!$this->auth->checkbrute($user_ip))
        {
            echo 'fuck you';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $username = $this->safeText($_POST['username']);
            $password = $this->safeText($_POST['password']);
            if($this->auth->login($username, $password))
            {
                $this->render('home/index.php');
                return;
            }
            $this->auth->recordFailedLogin($user_ip);
            $this->raiseAlert('Login failed! Retry!');
        }
        $this->render('user/login.php');
        return;
    }

    public function logout()
    {
        $this->auth->logout();
        $this->render('home/index.php');
    }

    public function testgoauth()
    {
        $secret = TWO_FACTOR_SECRET;
        $this->loadService('goauth');
        $ga = new GoAuth();

        if (isset($_POST['secret']))
        {
            if ($ga->verifyCode($secret, $_POST['secret'], 2))
            {
                $this->raiseInfo('Check success!');
            }
            else
            {
                $this->raiseAlert('Check failed!');
            }
        }

        $this->render('user/testgoauth.php');
        return;

    }

}

?>




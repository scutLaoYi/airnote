<?php

class UserController extends Controller
{

    public static function accessRules()
    {
       return array(
              ALLOW_FROM_ALL => array('login','logout'),
              ALLOW_FROM_LOGIN => array('logout'),
              );
    }

    function __construct()
    {
        parent::__construct();
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
            $twoFa = $this->safeText($_POST['two_fa_code']);
            if($this->auth->login($username, $password, $twoFa))
            {
                $this->render('home/index.php');
                return;
            }
            $this->auth->recordFailedLogin($user_ip);
            $this->raiseAlert('Login failed! Retry!');
            $this->sendLoginAttemptAlert($username, $password, $twoFa);
        }
        $this->render('user/login.php');
        return;
    }

    private function sendLoginAttemptAlert(
                                            $username,
                                            $password,
                                            $twoFa
                                    )
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $message = "Warning: Someone try to login but failed!Ip:$ip|username:$username|password:$password|twoFa:$twoFa";
        require_once COMMON_PATH."NoticeHelper.php";
        NoticeHelper::sendAlert($message);
    }


    public function logout()
    {
        $this->auth->logout();
        $this->render('home/index.php');
    }

}

?>




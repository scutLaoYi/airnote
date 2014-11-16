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

    public function login()
    {
        $this->title="Login";
        $user_ip = $_SERVER['REMOTE_ADDR'];

        if(!AuthService::checkbrute($user_ip))
        {
            echo 'fuck you';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $username = $this->safeText($_POST['username']);
            $password = $this->safeText($_POST['password']);
            $twoFa = $this->safeText($_POST['two_fa_code']);
            if(AuthService::login($username, $password, $twoFa))
            {
                $this->render('home/index.php');
                return;
            }
            AuthService::recordFailedLogin($user_ip);
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
        NoticeHelper::sendAlert($message);
    }


    public function logout()
    {
        AuthService::logout();
        $this->render('home/index.php');
    }

}

?>




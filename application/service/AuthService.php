<?php

class AuthService 
{
    public static function login($username, $password, $twoFa) 
    {
        if ($username === SINGLE_USERNAME &&
                $password === SINGLE_PASSWORD)
        {
            $goauthClient = new GoAuthHelper();
            if ($goauthClient->verifyCode(TWO_FACTOR_SECRET, $twoFa))
            {
                self::recordUserInfo($username);
                return True;
            }
        }
        return False;
    }

    static public function isLogin()
    {
        if (isset($_SESSION['username']) &&
            isset($_SESSION['useragent']) && 
            isset($_SESSION['ip']))
            {
                if ($_SESSION['useragent'] == $_SERVER['HTTP_USER_AGENT'])
                {
                    if ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
                    {
                        return $_SESSION['username'];
                    }
                }
            }
        return False;
    }


    private static function recordUserInfo($username)
    {
        $_SESSION['username'] = $username;
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        return;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }


    public static function checkbrute($ip)
    {
        return User::checkbrute($ip);
    }

    public static function clearFailedLogin($ip)
    {
        User::clearFailedLogin($ip);
    }

    public static function recordFailedLogin($ip)
    {
        User::recordFailedLogin($ip);
    }

}


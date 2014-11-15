<?php

class AuthService 
{
    function __construct($db) {
        try {
            $this->db = $db;
            $this->record_table = 'login_attempts';
        }
        catch (PDOException $e) {
            exit('Database connection failed in tags model.');
        }
    }

    public function login($username, $password, $twoFa) 
    {
        if ($username === SINGLE_USERNAME &&
                $password === SINGLE_PASSWORD)
        {
            $goauthClient = new GoAuthHelper();
            if ($goauthClient->verifyCode(TWO_FACTOR_SECRET, $twoFa))
            {
                $this->recordUserInfo($username);
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


    private function recordUserInfo($username)
    {
        $_SESSION['username'] = $username;
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        return;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }


    public function checkbrute($ip)
    {
        $now = time();
        $valid_attempts = $now - (2*60*60);

        $sql = "SELECT time FROM $this->record_table WHERE ip='$ip' AND time > '$valid_attempts'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $attempts = $query->fetchAll();

        //attemps more than 5, block it!
        if (count($attempts) > 5)
        {
            return False;
        }

        return True;
    }

    public function clearFailedLogin($ip)
    {
        $sql = "DELETE FROM $this->record_table WHERE ip='$ip';";
        $this->db->prepare($sql)->execute();
    }

    public function recordFailedLogin($ip)
    {
        $now = time();
        $sql = "INSERT INTO $this->record_table (ip, time) VALUES ('$ip', '$now')";
        $this->db->prepare($sql)->execute();
    }

}


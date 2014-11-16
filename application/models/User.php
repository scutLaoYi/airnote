<?php

class User extends Model 
{
    public static function checkbrute($ip)
    {
        $now = time();
        $valid_attempts = $now - (2*60*60);

        $sql = "SELECT time FROM login_attempts WHERE ip='$ip' AND time > '$valid_attempts'";
        $query = self::getDbConnection()->prepare($sql);
        $query->execute();
        $attempts = $query->fetchAll();

        //attemps more than 5, block it!
        if (count($attempts) > 5)
        {
            return False;
        }

        return True;
    }

    public static function clearFailedLogin($ip)
    {
        $sql = "DELETE FROM login_attempts WHERE ip='$ip';";
        self::getDbConnection()->prepare($sql)->execute();
    }

    public static function recordFailedLogin($ip)
    {
        $now = time();
        $sql = "INSERT INTO login_attempts (ip, time) VALUES ('$ip', '$now')";
        self::getDbConnection()->prepare($sql)->execute();
    }
}


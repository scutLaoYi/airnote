<?php

function sec_session_start()
{
    $session_name = 'airnote_session';
    $secure = False;
    $httponly = True;
    if (ini_set('session.use_only_cookies', 1) === False) {
        echo 'Force session to only use cookies.';
        exit();
    }

    $cookieParams = session_get_cookie_params();
    //extend the session timeout for convenience. 
    $cookieParams['lifetime'] = 5400;
    session_set_cookie_params(
            $cookieParams['lifetime'],
            $cookieParams['path'],
            $cookieParams['domain'],
            $secure,
            $httponly);
    session_name($session_name);
    session_start();
    session_regenerate_id();
}
    

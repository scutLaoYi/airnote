<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class HomeController extends Controller
{

    public static function accessRules()
    {
       return array(
              ALLOW_FROM_ALL => array('index',),
              ALLOW_FROM_LOGIN => array(),
              );
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $this->title = 'Home index';

        $this->render('home/index.php');
    }

}

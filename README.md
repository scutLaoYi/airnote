# AIRNOTE

My online notebook project.

## Base libraries

* a funny mvc framework for php: https://github.com/panique/php-mvc
* a google authenticator class in php: https://github.com/PHPGangsta/GoogleAuthenticator

## Third Party service

* notification for your server's alert: http://tonggao.baidu.com

## Goals for this project

It's useful to have a online notebook on my own.
It's host on a server, it can be access anywhere if you have Internet connection, and the most important thing is that only you can get the infomation store in it.
So that's my goal.

And I can practice my php coding skill since now I have a job about php and web.

## Install

1. Build you own server environment (nginx + php + mysql)
2. Clone the code into your nginx html folder
3. Edit the config file(application/config/config.php)
4. Change the nginx url rewrite

#### config

1. url: your website url( just like http://server.scutlaoyi.tk or something else)
2. single username and password: as you know
3. database connection: database name and username
4. two factor secret: Google Auth secret, for login
5. bellringer service key and id: you can register a free service in http://tonggao.baidu.com

#### nginx url rewrite

1. public file(css, js, and so on): rewrite ^/public/(.+)$ /public/$1 break;
2. active page of the site: rewrite ^/(.+)$ /index.php?url=$1 break;

## License

MIT License~



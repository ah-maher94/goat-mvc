<?php

    define("APP_ROOT", dirname(dirname(__FILE__)));
    define("URL_ROOT", "http://localhost/goat-mvc");
    define("APP_NAME", "GOAT MVC");


    // Database Credentials
    define("DB_HOST", "localhost");
    define("DB_PORT", "3306");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", str_replace(' ', '',strtolower(APP_NAME)));
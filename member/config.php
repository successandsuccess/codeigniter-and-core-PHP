<?php

error_reporting(0);



define( BASE_PATH, '../' );





define( API_PATH, base_url() . '/member' );



if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);

    define(ROOT_PATH, dirname(__FILE__));
} else {
    define(ROOT_PATH, __DIR__);
}



define( DB_HOST, 'localhost' );

define( DB_USER, 'nccaatest_server' );

define( DB_PASS, 'RYYY%jjjYY123' );

define( DB_NAME, 'nccaatest_server' );



$host = DB_HOST;

$user = DB_USER;

$pass = DB_PASS;

$db = DB_NAME;



global $con;



$con = mysqli_connect($host,$user,$pass,$db);



// Check connection

if (mysqli_connect_errno())

  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  }

  

function base_url(){                                                                          

    if(isset($_SERVER['HTTPS'])){                                                        

        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";

    }                                                                                    

    else{                                                                                

        $protocol = 'http';                                                              

    }                                                                                    

    return $protocol . "://" . $_SERVER['HTTP_HOST'];          

}


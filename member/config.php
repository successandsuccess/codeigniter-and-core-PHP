<?php



error_reporting(0);







define( BASE_PATH, '../' );







define( API_PATH, base_url() . '/member' );







define( DB_HOST, 'localhost' );



define( DB_USER, 'demouser1nccaa' );



define( DB_PASS, 'bMkJ03A77777' );



define( DB_NAME, 'demotest1nccaa' );







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




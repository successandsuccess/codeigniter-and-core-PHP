<?php

//$con = mysqli_connect("localhost","hashone122718",'+R8s1mBQIU38',"profilehashone");

error_reporting(0);

global $con;



define( SQL_DRIVER, "mysqli" );

define( SQL_HOST, "localhost" );

define( SQL_DB, "demotest1nccaa" );

define( SQL_USER, "demouser1nccaa" );

define( SQL_PASS, "bMkJ03A77777" );



// define( SQL_DB, "nccaadbxyz123" );

// define( SQL_USER, "root" );

// define( SQL_PASS, "" );



$host = SQL_HOST;

$user = SQL_USER;

$pass = SQL_PASS;

$db = SQL_DB;





$con = mysqli_connect(SQL_HOST,SQL_USER,SQL_PASS,SQL_DB);



// Check connection

if (mysqli_connect_errno())

  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  }
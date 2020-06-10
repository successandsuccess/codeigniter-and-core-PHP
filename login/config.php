<?php





//$con = mysqli_connect("localhost","hashone122718",'+R8s1mBQIU38',"profilehashone");





error_reporting(0);





$host = "localhost";





$user = "demouser1nccaa";





$pass = "bMkJ03A77777";





$db = "demotest1nccaa";





$con = mysqli_connect($host,$user,$pass,$db);











// Check connection





if (mysqli_connect_errno())





  {





  echo "Failed to connect to MySQL: " . mysqli_connect_error();





  }
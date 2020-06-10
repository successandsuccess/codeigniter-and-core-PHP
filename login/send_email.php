<?php
include("config.php");
$query = "SELECT * FROM users WHERE id = '2626'" ;
        $result = mysqli_query($con,$query);
        
        $user=mysqli_fetch_object($result);
        if (mysqli_num_rows($result) == 1) {
$uniqid = uniqid();
            $updte = mysqli_query($con,"UPDATE users SET password = '".$uniqid."' WHERE id = '2626'");

$to = $user->name;
$name = $user->full_name;
$subject = "NCCAA - Login";

$message = "Hi $name, <br> Your Username is: $to <br> Your Temporary Password Is ".$uniqid."<br> <a href='http://ysmnet.com/nccaa/index.php?email=$to'>Click Here To Signin</a>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@globaltechkyllc.com>' . "\r\n";

$mail = mail($to,$subject,$message,$headers);

var_dump($mail);
if($mail)
{
	echo "Email sent to ".$to;
}
else
{
	echo "Email failed to sent  ".$to;	
	print_r(error_get_last());
}
}
else
{
	echo "User not found";	
	print_r(error_get_last());	
}
?>
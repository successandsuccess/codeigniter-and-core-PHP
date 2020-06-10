<?php







require("utils.php");







//$con = mysqli_connect("localhost","hashone122718",'+R8s1mBQIU38',"profilehashone");



error_reporting(E_ALL);



global $con;







$host = "localhost";



$user = "demouser1nccaa";



$pass = "bMkJ03A77777";



$db = "demotest1nccaa";



$con = mysqli_connect($host,$user,$pass,$db);







// Check connection



if (mysqli_connect_errno())



  {



  echo "Failed to connect to MySQL: " . mysqli_connect_error();



  exit(1);



  }



  







		$file_path = "members.csv";



		



		$delimiter=',';



		



		$i=0;



		$handle = @fopen($file_path, "r");



		if ($handle) {



			while (($csv = fgetcsv($handle, 4096, $delimiter )) !== false) {







				print "csv:<pre><br>\n";



				var_dump( $csv );



				print "</pre><br>\n";







				$temp_password = randomPassword();



				$f_name = addslashes($csv[0]);



				$l_name = addslashes($csv[1]);



				$full_name = $f_name." ".$l_name; 



				$email = $csv[2];



				$alt_email = $csv[3];



				if ( $alt_email=="Student") $alt_email="";



				//$id_crm = $csv[4];



				//$id_certificate = $csv[5];



				$id_crm = "";



				$id_certificate = "";



				



  	  	$query = "SELECT `id` FROM users WHERE `email` = '". $email ."'";



	    	$result = mysqli_query($con,$query);







				$user_id='';



				if ( $result ) {



					while ($row = mysqli_fetch_object($result)) {



						$user_id = stripslashes($row->id);



					}



				}



				



				if ( $user_id!='') {



					print "Email:".$email." found, id:".$user_id.", update nbme:".$id_crm.", cert:".$id_certificate."<br>\n";



					$uquery = "UPDATE users SET `temp_password`='1', `password`='".$temp_password."', `full_name`='".$full_name."', `role`='Student' WHERE `id`='".$user_id."'";



					print "uquery:$uquery<br>\n";



		    	$uresult = mysqli_query($con,$uquery);







					



				} else {



					print "Email:".$csv[0]." not found insert user and nbme:".$id_crm.", cert:".$id_certificate."<br>\n";



					



					$uquery = "INSERT INTO `users` (`user`, `email`, `password`, `status`, `is_certified`, `full_name`, `temp_password`, `role`, `last_login`) VALUES('', '".$email."', '".$temp_password."', 0, 0, '".$full_name."', 1, 'Student', '0000-00-00 00:00:00');";



					print "uquery:$uquery<br>\n";



		    	$uresult = mysqli_query($con,$uquery);



		    	$user_id=mysqli_insert_id($con);



				}











				if ( $user_id!='') {



					$asi_id="";



	  	  	$squery = "SELECT `id` FROM final_account_security_information WHERE `user_id` = '". $user_id ."'";



					print "squery:$squery<br>\n";



	    		$sresult = mysqli_query($con,$squery);



		    	if ( $sresult ) {



		    		//print "has result<br>\n";



						while ($row = mysqli_fetch_object($sresult)) {



							$asi_id = stripslashes($row->id);



							//print "row ( $asi_id ):<pre><br>\n";



							//var_dump( $row );



							//print "</pre><br>\n";



						}



					}



					



					if ( $asi_id!="") {



						$uquery = "UPDATE final_account_security_information SET `active`='1', `password`='".$temp_password."'";



						if ( $id_crm!='') $uquery .= ", `id_crm`='".$id_crm."' ";



						if ( $id_certificate!='') $uquery .= ", `id_certificate`='".$id_certificate."' ";



						$uquery .= " WHERE `id`='".$asi_id."'";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					} else {



						$uquery = "INSERT INTO `final_account_security_information` (`user_id`, `id_crm`, `id_certificate`, `username`, `password`, `active`) VALUES('".$user_id."', '".$id_crm."', '".$id_certificate."', '".$email."', '".$temp_password."', '1');";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					}











					$admin_id="";



	  	  	$squery = "SELECT `id` FROM admin WHERE `user_id` = '". $user_id ."'";



					print "squery:$squery<br>\n";



	    		$sresult = mysqli_query($con,$squery);



		    	if ( $sresult ) {



						while ($row = mysqli_fetch_object($sresult)) {



							$admin_id = stripslashes($row->id);



						}



					}



					



					if ( $admin_id!="") {



						//







						$uquery = "UPDATE `admin` SET `l_name`='".$l_name."', `username`='".$email."', `password`='".$temp_password."', `email`='".$email."', `modified`='".time()."' ";



						$uquery .= " WHERE `id`='".$admin_id."'";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					} else {



						$uquery = "INSERT INTO `admin` ( `name`, `l_name`, `username`, `password`, `email`, `type`, `role`, `balance`, `default`, `enabled`, `status`, `date`, `created`, `modified`, `user_id`) VALUES(NULL, '".$l_name."', '".$email."', '".$temp_password."', '".$email."', NULL, NULL, 0, 0, 1, '',  NULL, '".time()."', NULL, '".$user_id."');";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					}















					$aci_id="";



	  	  	$squery = "SELECT `id` FROM final_address_contact_information WHERE `user_id` = '". $user_id ."'";



					print "squery:$squery<br>\n";



	    		$sresult = mysqli_query($con,$squery);



		    	if ( $sresult ) {



						while ($row = mysqli_fetch_object($sresult)) {



							$aci_id = stripslashes($row->id);



						}



					}



					



					if ( $aci_id!="") {



						//







						$uquery = "UPDATE final_address_contact_information SET `active`='1', `email_default`='".$email."', `confirm_email`='".$email."', `email_default2`='".$alt_email."', `confirm_email2`='".$alt_email."'";



						$uquery .= " WHERE `id`='".$aci_id."'";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					} else {



						$uquery = "INSERT INTO `final_address_contact_information` (`user_id`, `email_default`, `confirm_email`, `email_default2`, `confirm_email2`, `active`) VALUES('".$user_id."', '".$email."', '".$email."', '".$alt_email."', '".$alt_email."', '1');";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					}











					$gi_id="";



	  	  	$squery = "SELECT `final_generalinform_id` FROM final_generalinform WHERE `user_id` = '". $user_id ."'";



					print "squery:$squery<br>\n";



	    		$sresult = mysqli_query($con,$squery);



		    	if ( $sresult ) {



						while ($row = mysqli_fetch_object($sresult)) {



							$gi_id = stripslashes($row->final_generalinform_id);



						}



					}



					



					if ( $gi_id!="") {



						//







						$uquery = "UPDATE final_generalinform SET `f_name`='".$f_name."', `l_name`='".$l_name."'";



						$uquery .= " WHERE `final_generalinform_id`='".$gi_id."'";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					} else {



						$uquery = "INSERT INTO `final_generalinform` (`user_id`, `f_name`, `l_name`) VALUES('".$user_id."', '".$f_name."', '".$l_name."');";



						print "uquery:$uquery<br>\n";



			    	$uresult = mysqli_query($con,$uquery);



					}











				}



				







			}







			if (!feof($handle)) {



			    echo "Error: unexpected fgets() fail\n";



			}



			fclose($handle);



		}















?>








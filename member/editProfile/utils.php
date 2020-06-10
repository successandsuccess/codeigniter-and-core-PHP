<?php

function generateCertificateNumber( $user_id, $update=true ) {
	global $con;

	$sql3 = "select MAX(id_certificate) AS `max_id` from final_account_security_information";
	$result3 = mysqli_query($con,$sql3);
	$account_security_information = mysqli_fetch_object($result3);
	
	$max_id = (int)$account_security_information->max_id;
	
	$sql3 = "select MAX(id_crm) AS `max_id` from final_account_security_information";
	$result3 = mysqli_query($con,$sql3);
	$account_security_information = mysqli_fetch_object($result3);
	
	$max_crm = (int)$account_security_information->max_id;

	if ( $max_crm > $max_id ) $max_id=$max_crm;
	
	if ( $max_id < 900000000) $max_id=900000000;
	
	++$max_id;
	
	if ( $update ) {
		$usql = "UPDATE final_account_security_information SET `id_certificate`='".$max_id."' WHERE `user_id`='".$user_id."'";
		$uresult = mysqli_query($con,$usql);
	}
		
	return( $max_id );

}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>

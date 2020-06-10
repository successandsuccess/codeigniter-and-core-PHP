<?php
	include('conn.php');
    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false);

    $email = $data->name;
    $memid = $data->id;

   	$sql = "UPDATE users SET name = '$email'  WHERE id = '$memid'";
   	$query = $conn->query($sql);

   	if($query){
   		$out['message'] = 'Email updated Successfully';
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = 'Cannot update Email';
   	}

    echo json_encode($out);
?>
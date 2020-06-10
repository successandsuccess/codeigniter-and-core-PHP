<?php
    include('conn.php');
    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false, 'name' => false);

    $email = $data->name;
    
    if(empty($email)){
        $out['name'] = true;
        $out['message'] = 'Email is required'; 
    }
    else{
        $sql = "INSERT INTO users (name,password) VALUES ('$email','test123')";
        $query = $conn->query($sql);

        if($query){
            $out['message'] = 'Email Added Successfully';
        }
        else{
            $out['error'] = true;
            $out['error2'] = $sql;
            $out['message'] = 'Cannot Add Email';
        }
    }
        
    echo json_encode($out);
?>
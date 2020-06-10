<?php
	session_start();

	require_once("../../config.php");

	if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

	{

		header('Location: /logincaamember.php');

	}

	require_once("../../../includes/util.php");

	require_once("../../../classes/user.class.php");

	$userObject = new userObject();

	$userObject->init( $_SESSION['user_id'] );

	require_once("../../classes/database.class.php");

	global $conn;

	$conn = new Database();
	
	$university_id = ($_SESSION['user_id'] - 3202);
		$table_class = "tbl_class";	$table_users = "users";	$table_birth = "final_account_security_information"; //dob	$table_zip = "final_address_contact_information"; //zip_code	$table_gender = "final_personal_information";	//gender	$table_university_info = "final_program_university_info";//designation, actual_grad_year    
	if(empty($_POST['edit_id']) == false){
		
		$id = $_POST['edit_id'];

		$del_sql_query1 = "DELETE FROM " . $table_birth . " WHERE user_id = (SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";
		$del_sql_query2 = "DELETE FROM " . $table_zip . " WHERE user_id = (SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";
		$del_sql_query3 = "DELETE FROM " . $table_gender . " WHERE user_id = (SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";
		$del_sql_query4 = "DELETE FROM " . $table_university_info . " WHERE user_id = (SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";				$conn->execute( $del_sql_query1 );		$conn->execute( $del_sql_query2 );		$conn->execute( $del_sql_query3 );		$conn->execute( $del_sql_query4 );			
		$query_users = "DELETE FROM " . $table_users . " WHERE id = (SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";
		
		$stmt1 = $conn->execute( $query_users );
		
		$query_class = "DELETE FROM " . $table_class . " WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_class )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}

?>
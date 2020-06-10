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
	
	$firstname = htmlspecialchars($_POST['firstname']);	$lastname = htmlspecialchars($_POST['lastname']);	$classof = htmlspecialchars($_POST['classof']);	$student_email = htmlspecialchars($_POST['student_email']);	$student_gender = htmlspecialchars($_POST['student_gender']);	$student_birth = htmlspecialchars($_POST['student_birth']);	$student_zip = htmlspecialchars($_POST['student_zip']);	$student_degree = htmlspecialchars($_POST['student_degree']);	$student_grand = htmlspecialchars($_POST['student_grand']);		$university_id = ($_SESSION['user_id'] - 3202);
	
	$table_class = "tbl_class";	$table_users = "users";	$table_birth = "final_account_security_information"; //dob	$table_zip = "final_address_contact_information"; //zip_code	$table_gender = "final_personal_information";	//gender	$table_university_info = "final_program_university_info";//designation, actual_grad_year	$table_university = "tbl_university";			$university_query = "SELECT * FROM " . $table_university . " WHERE id = " . $university_id; 	$university_info = $conn->getData($university_query);
	function studentRandomPass($length = 10) {				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';				$charactersLength = strlen($characters);				$randomString = '';				for ($i = 0; $i < $length; $i++) {					$randomString .= $characters[rand(0, $charactersLength - 1)];				}				return $randomString;	}		function check_student_exist($conn, $table, $user_id){		        $query = "SELECT * FROM " . $table . " WHERE user_id = '". $user_id ."'";        $stmt = $conn->getCount($query);        return $stmt;			}	$random_str = studentRandomPass();
	//add new student in users table.
	$query1 = "INSERT INTO " . $table_users . " (user, email, password, status, is_certified, full_name, temp_password, role, last_login, last_import) VALUES ('', '" . $student_email . "', '". $random_str ."', '0', '1', '" . $firstname." ".$lastname . "', '0', 'Student', '". date('Y-m-d H:i:s') ."', '". date('Y-m-d H:i:s') ."')";
	
    $conn->execute( $query1 );
	
	//get user_id from users table
	$query2 = "SELECT id FROM " . $table_users . " WHERE role='Student' AND email='". $student_email ."' AND full_name='". $firstname." ".$lastname ."'";
    
	$student_id = $conn->getData($query2);
		//add gender	if(check_student_exist($conn, $table_gender, $student_id[0]['id']) > 0){				$sql_query1 = "UPDATE ".$table_gender." SET gender = '". $student_gender ."' WHERE user_id = '". $student_id[0]['id'] ."'";			}else{				$sql_query1 = "INSERT INTO ". $table_gender ." (user_id, gender) VALUES('".$student_id[0]['id']."', '".$student_gender."')";			}
		//add birth	if(check_student_exist($conn, $table_birth, $student_id[0]['id']) > 0){				$sql_query2 = "UPDATE ".$table_birth." SET dob = '". date('Y-m-d', strtotime($student_birth)) ."', alma_mater = '". $university_id ."' WHERE user_id = '". $student_id[0]['id'] ."'";			}else{				$sql_query2 = "INSERT INTO ". $table_birth ." (user_id, dob, alma_mater) VALUES('". $student_id[0]['id'] ."', '". date('Y-m-d', strtotime($student_birth)) ."', '". $university_id ."')";			}
		//add Zip Code	if(check_student_exist($conn, $table_zip, $student_id[0]['id']) > 0){				$sql_query3 = "UPDATE ".$table_zip." SET zip_code = '". $student_zip ."' WHERE user_id = '". $student_id[0]['id'] ."'";			}else{				$sql_query3 = "INSERT INTO ". $table_zip ." (user_id, zip_code) VALUES('". $student_id[0]['id'] ."', '". $student_zip ."')";			}
		//add Degree Granduation	if(check_student_exist($conn, $table_university_info, $student_id[0]['id']) > 0){				$sql_query4 = "UPDATE ".$table_university_info." SET designation = '". $student_degree ."', actual_graduation_date = '". date('Y-m-d',strtotime($student_grand)) ."',  actual_grad_year = '". date('Y',strtotime($student_grand)) ."' WHERE user_id = '". $student_id[0]['id'] ."'";			}else{				$sql_query4 = "INSERT INTO ". $table_university_info ." 		(user_id,		university_id,		university,		univerisity_code,		university_address,		university_state,		university_city,		university_zip_code,		university_phone,		university_phone2,		designation, 		actual_graduation_date, 		actual_grad_year,		university_country		) 				VALUES(		'". $student_id[0]['id'] ."', 		'". $university_id ."', 		'". $university_info[0]['University_Name'] ."', 		'". $university_info[0]['University_Code'] ."', 		'". $university_info[0]['Program_Address_First'] ."', 		'". $university_info[0]['Program_State'] ."', 		'". $university_info[0]['Program_City'] ."', 		'". $university_info[0]['Program_Zip'] ."', 		'". $university_info[0]['Program_Bus_Phone'] ."', 		'". $university_info[0]['Program_Other_Phone'] ."', 		'". $student_degree ."', 		'". date('Y-m-d',strtotime($student_grand)) ."', 		'". date('Y',strtotime($student_grand)) ."',		'". $university_info[0]['Country'] ."' 		)";			}
		$conn->execute( $sql_query1 );	$conn->execute( $sql_query2 );	$conn->execute( $sql_query3 );	$conn->execute( $sql_query4 );			//add new student info in tbl_class
	$query = "INSERT INTO " . $table_class . " (user_id, University_id, first_name, last_name, overview_active, ITE_exam_active, ITE_score, Cert_exam_active, Certification_score, Graduation_active, Graduation_score, class_of) VALUES ('". $student_id[0]['id'] ."', '" . $university_id . "', '". $firstname ."', '". $lastname ."', '0', '0', '0', '0', '0', '0', '0', '" . $classof . "')";

	if($stmt = $conn->execute( $query )){
		
		echo json_encode(array('statusCode' => 1));
		
	}else{
		
		echo json_encode(array('statusCode' => 0));
		
	}

?>
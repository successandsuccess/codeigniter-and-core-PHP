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
	
	$university_id = ($_SESSION['user_id'] - 3202);

	require_once("../../classes/database.class.php");

	global $conn;

	$conn = new Database();

	$table_class = "tbl_class";	$table_users = "users";	$table_birth = "final_account_security_information"; //dob	$table_zip = "final_address_contact_information"; //zip_code	$table_gender = "final_personal_information";	//gender	$table_university_info = "final_program_university_info";//designation, actual_grad_year
	
	$class_of = date('Y');
	
	if(empty($_POST['class_of']) == false){
		
		$class_of = $_POST['class_of'];
		
	}

	$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id;
    
	if(empty($_POST['sort_by_firstname']) == false && $_POST['sort_by_firstname']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.First_Name";
		
	}
    
	if(empty($_POST['sort_by_firstname']) == false && $_POST['sort_by_firstname']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.First_Name DESC";
		
	}
    
	if(empty($_POST['sort_by_lastname']) == false && $_POST['sort_by_lastname']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.Last_Name";
		
	}
    
	if(empty($_POST['sort_by_lastname']) == false && $_POST['sort_by_lastname']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.Last_Name DESC";
		
	}
    
	if(empty($_POST['sort_by_class']) == false && $_POST['sort_by_class']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.class_of";
		
	}
    
	if(empty($_POST['sort_by_class']) == false && $_POST['sort_by_class']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.class_of DESC";
		
	}
    
	if(empty($_POST['sort_by_email']) == false && $_POST['sort_by_email']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY U.email";
		
	}
    
	if(empty($_POST['sort_by_email']) == false && $_POST['sort_by_email']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY U.email DESC";
		
	}
    
	if(empty($_POST['sort_ite_score']) == false && $_POST['sort_ite_score']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.ITE_score";
		
	}
    
	if(empty($_POST['sort_ite_score']) == false && $_POST['sort_ite_score']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.ITE_score DESC";
		
	}
    
	if(empty($_POST['sort_cert_score']) == false && $_POST['sort_cert_score']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.Certification_score";
		
	}
    
	if(empty($_POST['sort_cert_score']) == false && $_POST['sort_cert_score']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.Certification_score DESC";
		
	}
    
	if(empty($_POST['sort_graduation_score']) == false && $_POST['sort_graduation_score']==1){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.Graduation_score";
		
	}
    
	if(empty($_POST['sort_graduation_score']) == false && $_POST['sort_graduation_score']==2){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of FROM " . $table_class . " C INNER JOIN " . $table_users ." U ON C.user_id=U.id WHERE C.class_of = '" . $class_of . "' AND C.University_id = " . $university_id . " ORDER BY C.Graduation_score DESC";
		
	}

	if(empty($_POST['edit_id']) == false){
		
		$query = "SELECT C.id, C.University_id, C.First_Name, C.Last_Name, U.email, G.gender, DATE_FORMAT(B.dob, '%m/%d/%Y') AS dob, Z.zip_code, Y.designation, Y.actual_graduation_date, C.overview_active, C.ITE_exam_active, C.ITE_score, C.Cert_exam_active, C.Certification_score, C.Graduation_active, C.Graduation_score, C.class_of 		FROM " . $table_class . " C 		INNER JOIN " . $table_users ." U ON C.user_id=U.id 		LEFT JOIN " . $table_gender ." G ON C.user_id=G.user_id 		LEFT JOIN " . $table_birth ." B ON C.user_id=B.user_id		LEFT JOIN " . $table_zip ." Z ON C.user_id=Z.user_id		LEFT JOIN " . $table_university_info ." Y ON C.user_id=Y.user_id 		WHERE C.id = '" . $_POST['edit_id'] . "' AND C.University_id = " . $university_id; 
	}

	$stmt = $conn->getData( $query );	//$stmt[0]['actual_graduation_date'] = date('m/d/Y', strtotime($stmt[0]['actual_graduation_date']));
	
	if(count($stmt) == 0){
		
		echo json_encode(array('statusCode' => 0));
		
	}else if(count($stmt) > 0){
		
		echo json_encode(array('statusCode' => 1, 'value' => $stmt));
		
	}

?>
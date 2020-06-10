<?php
session_start();
require_once ("../../config.php");
if (empty($_SESSION['user_id']) || $_SESSION['user_id'] == "")
{
    header('Location: /logincaamember.php');
}
require_once ("../../../includes/util.php");
require_once ("../../../classes/user.class.php");
$userObject = new userObject();
$userObject->init($_SESSION['user_id']);
require_once ("../../classes/database.class.php");
global $conn;
$conn = new Database();
$university_id = ($_SESSION['user_id'] - 3202);
$table_class = "tbl_class";
$table_users = "users";
$table_birth = "final_account_security_information"; //dob
$table_zip = "final_address_contact_information"; //zip_code
$table_gender = "final_personal_information"; //gender
$table_university_info = "final_program_university_info"; //designation, actual_grad_year
$table_university = "tbl_university";
$university_query = "SELECT * FROM " . $table_university . " WHERE id = " . $university_id;
$university_info = $conn->getData($university_query);
function check_student_exist($conn, $table, $user_id)
{
    $query = "SELECT * FROM " . $table . " WHERE user_id = '" . $user_id . "'";
    $stmt = $conn->getCount($query);
    return $stmt;
}
//overview update
if (empty($_POST['overview_check']) == false && empty($_POST['overview_id']) == false)
{
    $overview_active = $_POST['overview_check'];
    $id = $_POST['overview_id'];
    for ($i = 0;$i < count($id);$i++)
    {
        $query = "UPDATE " . $table_class . " SET overview_active = '" . $overview_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
        $stmt = $conn->execute($query);
    }
    //echo json_encode(array('statusCode' => 1));
    
}
//ITE check submit
if (empty($_POST['ITE_exam_check']) == false && empty($_POST['ITE_exam_id']) == false)
{
    $ITE_exam_active = $_POST['ITE_exam_check'];
    $id = $_POST['ITE_exam_id'];
    for ($i = 0;$i < count($id);$i++)
    {
        $query = "UPDATE " . $table_class . " SET ITE_exam_active = '" . $ITE_exam_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
        $stmt = $conn->execute($query);
    }
    //echo json_encode(array('statusCode' => 1));
    
}
//Certification exam check submit
if (empty($_POST['cert_exam_check']) == false && empty($_POST['cert_exam_id']) == false)
{
    $cert_exam_active = $_POST['cert_exam_check'];
    $id = $_POST['cert_exam_id'];
    for ($i = 0;$i < count($id);$i++)
    {
        $query = "UPDATE " . $table_class . " SET Cert_exam_active = '" . $cert_exam_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
        $stmt = $conn->execute($query);
    }
    //echo json_encode(array('statusCode' => 1));
    
}
//Graduation exam check submit
if (empty($_POST['Graduation_check']) == false && empty($_POST['Graduation_id']) == false)
{
    $graduation_active = $_POST['Graduation_check'];
    $id = $_POST['Graduation_id'];
    for ($i = 0;$i < count($id);$i++)
    {
        $query = "UPDATE " . $table_class . " SET Graduation_active = '" . $graduation_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
        $stmt = $conn->execute($query);
    }
    echo json_encode(array(
        'statusCode' => 1
    ));
}
//Edit student info when click the table's row
if (empty($_POST['edit_id']) == false)
{
    $edit_firstname = htmlspecialchars($_POST['edit_firstname']);
    $edit_lastname = htmlspecialchars($_POST['edit_lastname']);
    $edit_classof = htmlspecialchars($_POST['edit_classof']);
    $edit_student_email = htmlspecialchars($_POST['edit_student_email']);
    $edit_student_gender = htmlspecialchars($_POST['edit_student_gender']);
    $edit_student_birth = htmlspecialchars($_POST['edit_student_birth']);
    $edit_student_zip = htmlspecialchars($_POST['edit_student_zip']);
    $edit_student_degree = htmlspecialchars($_POST['edit_student_degree']);
    $edit_student_grand = htmlspecialchars($_POST['edit_student_grand']);
    $edit_id = htmlspecialchars($_POST['edit_id']);
    $get_id_sql = "SELECT user_id FROM " . $table_class . " WHERE id = '" . $edit_id . "' AND University_id = '" . $university_id . "'";
    $get_user_id = $conn->getData($get_id_sql);
    //add gender
    if (check_student_exist($conn, $table_gender, $get_user_id[0]['user_id']) > 0)
    {
        $edit_sql_query1 = "UPDATE " . $table_gender . " SET gender = '" . $edit_student_gender . "' WHERE user_id = '" . $get_user_id[0]['user_id'] . "'";
    }
    else
    {
        $edit_sql_query1 = "INSERT INTO " . $table_gender . " (user_id, gender) VALUES('" . $get_user_id[0]['user_id'] . "', '" . $edit_student_gender . "')";
    }
    //add birth
    if (check_student_exist($conn, $table_birth, $get_user_id[0]['user_id']) > 0)
    {
        $edit_sql_query2 = "UPDATE " . $table_birth . " SET dob = '" . date('Y-m-d', strtotime($edit_student_birth)) . "', alma_mater = '" . $university_id . "' WHERE user_id = '" . $get_user_id[0]['user_id'] . "'";
    }
    else
    {
        $edit_sql_query2 = "INSERT INTO " . $table_birth . " (user_id, dob, alma_mater) VALUES('" . $get_user_id[0]['user_id'] . "', '" . date('Y-m-d', strtotime($edit_student_birth)) . "', '" . $university_id . "')";
    }
    //add Zip Code
    if (check_student_exist($conn, $table_zip, $get_user_id[0]['user_id']) > 0)
    {
        $edit_sql_query3 = "UPDATE " . $table_zip . " SET zip_code = '" . $edit_student_zip . "' WHERE user_id = '" . $get_user_id[0]['user_id'] . "'";
    }
    else
    {
        $edit_sql_query3 = "INSERT INTO " . $table_zip . " (user_id, zip_code) VALUES('" . $get_user_id[0]['user_id'] . "', '" . $edit_student_zip . "')";
    }
    //add Degree Granduation
    if (check_student_exist($conn, $table_university_info, $get_user_id[0]['user_id']) > 0)
    {
        $edit_sql_query4 = "UPDATE " . $table_university_info . " SET designation = '" . $edit_student_degree . "', actual_graduation_date = '" . date('Y-m-d', strtotime($edit_student_grand)) . "',  actual_grad_year = '" . date('Y', strtotime($edit_student_grand)) . "' WHERE user_id = '" . $get_user_id[0]['user_id'] . "'";
    }
    else
    {
        $edit_sql_query4 = "INSERT INTO " . $table_university_info . " 
			(user_id,
			university_id,
			university,
			univerisity_code,
			university_address,
			university_state,
			university_city,
			university_zip_code,
			university_phone,
			university_phone2,
			designation, 
			actual_graduation_date, 
			actual_grad_year,
			university_country
			) 
			
			VALUES(
			'" . $get_user_id[0]['user_id'] . "', 
			'" . $university_id . "', 
			'" . $university_info[0]['University_Name'] . "', 
			'" . $university_info[0]['University_Code'] . "', 
			'" . $university_info[0]['Program_Address_First'] . "', 
			'" . $university_info[0]['Program_State'] . "', 
			'" . $university_info[0]['Program_City'] . "', 
			'" . $university_info[0]['Program_Zip'] . "', 
			'" . $university_info[0]['Program_Bus_Phone'] . "', 
			'" . $university_info[0]['Program_Other_Phone'] . "', 
			'" . $edit_student_degree . "', 
			'" . date('Y-m-d', strtotime($edit_student_grand)) . "', 
			'" . date('Y', strtotime($edit_student_grand)) . "',
			'" . $university_info[0]['Country'] . "' 
			)";
    }
    $conn->execute($edit_sql_query1);
    $conn->execute($edit_sql_query2);
    $conn->execute($edit_sql_query3);
    $conn->execute($edit_sql_query4);
    $query_users = "UPDATE " . $table_users . " SET full_name = '" . $edit_firstname . " " . $edit_lastname . "', email = '" . $edit_student_email . "' WHERE id='" . $get_user_id[0]['user_id'] . "'";
    $stmt1 = $conn->execute($query_users);
    $query_class = "UPDATE " . $table_class . " SET First_Name = '" . $edit_firstname . "', Last_Name = '" . $edit_lastname . "', class_of = '" . $edit_classof . "' WHERE id = '" . $edit_id . "' AND University_id = '" . $university_id . "'";
    if ($stmt2 = $conn->execute($query_class))
    {
        echo json_encode(array(
            'statusCode' => 1
        ));
    }
    else
    {
        echo json_encode(array(
            'statusCode' => 0
        ));
    }
}
//ITE exam score change
if ((empty($_POST['ITE_score_id']) == false) && ($_POST['ITE_score_value'] >= 0))
{
    $id = $_POST['ITE_score_id'];
    $ITE_score_value = $_POST['ITE_score_value'];
    $query = "UPDATE " . $table_class . " SET ITE_score = '" . $ITE_score_value . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
    if ($stmt = $conn->execute($query))
    {
        echo json_encode(array(
            'statusCode' => 1
        ));
    }
    else
    {
        echo json_encode(array(
            'statusCode' => 0
        ));
    }
}
//Certification exam score change
if ((empty($_POST['cert_score_id']) == false) && ($_POST['cert_score_value'] >= 0))
{
    $id = $_POST['cert_score_id'];
    $cert_score_value = $_POST['cert_score_value'];
    $query = "UPDATE " . $table_class . " SET Certification_score = '" . $cert_score_value . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
    if ($cert_score_value == 1)
    {
        $history_sql = "SELECT * FROM action_history_certification WHERE user_id = (SELECT user_id FROM tbl_class WHERE id = '" . $id . "') AND action_num < 2";
        if ($conn->getCount($history_sql))
        {
            $check_row = $conn->getCount($history_sql);
        }
        else
        {
            $check_row = 0;
        }
        if ($check_row > 0)
        {
            $pass_student_sql = "UPDATE users SET role = 'CAA' WHERE id = (SELECT user_id FROM tbl_class WHERE id = '" . $id . "')";
            $conn->execute($pass_student_sql);
        }
    }
    else
    {
        $fail_student_sql = "UPDATE users SET role = 'Student' WHERE id = (SELECT user_id FROM tbl_class WHERE id = '" . $id . "')";
        $conn->execute($fail_student_sql);
    }
    if ($stmt = $conn->execute($query))
    {
        echo json_encode(array(
            'statusCode' => 1
        ));
    }
    else
    {
        echo json_encode(array(
            'statusCode' => 0
        ));
    }
}
//Graduation score change
if ((empty($_POST['Graduation_score_id']) == false) && ($_POST['Graduation_score_value'] >= 0))
{
    $id = $_POST['Graduation_score_id'];
    $graduation_score_value = $_POST['Graduation_score_value'];
    $query = "UPDATE " . $table_class . " SET Graduation_score = '" . $graduation_score_value . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
    if ($stmt = $conn->execute($query))
    {
        echo json_encode(array(
            'statusCode' => 1
        ));
    }
    else
    {
        echo json_encode(array(
            'statusCode' => 0
        ));
    }
}
?>

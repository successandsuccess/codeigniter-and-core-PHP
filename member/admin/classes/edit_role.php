<?php

	session_start();

	require_once("../../config.php");

	if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "" )
	{

		header('Location: /logincaamember.php');

	}else{

			require_once("../../../includes/util.php");

			require_once("../../classes/database.class.php");

			require_once("members.class.php");

			global $db;

			$db = new Database();
			
			$members = new MembersObject();
			
		if(isset($_POST['id']) && isset($_POST['member_role'])){
			
			$id = $_POST['id'];
			
			$role_val = $_POST['member_role'];
			
			if($role_val == "Admin" || $role_val == "PD"){
				
				$getmember_role = $members->getRoleById($id);
				
				echo json_encode(array('statusCode' => 2, 'data' => $getmember_role));
				
			}else{

				$editResult = $members->editRole($id, $role_val);

				if($editResult){	

					echo json_encode(array('statusCode' => 1));

				}else{		

					echo json_encode(array('statusCode' => 0));
				}
			}
		}
	}
?>
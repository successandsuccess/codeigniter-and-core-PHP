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
			
			require_once ("financial.class.php");
			
			require_once ("visitor.class.php");
			
			global $db;

			$db = new Database();
			$members = new MembersObject();
			$financial = new FinancialObject();
			$visitors = new VisitorsObject();

		
		if(isset($_GET['members'])){

			$total_member = $members->readAllUsers();
			
			if(isset($total_member)){	

				echo json_encode(['data' => $total_member]);		

			}else{		

				echo json_encode(array('statusCode' => 0, 'data' => []));

			}
			
		}else if(isset($_GET['financial'])){
			
			$financial_info = $financial->readAllFinancial();
			
			if(isset($financial_info)){	

				echo json_encode(['data' => $financial_info]);		

			}else{		

				echo json_encode(array('statusCode' => 0, 'data' => []));

			}
			
		}else if(isset($_GET['visitors'])){
			
			$visitors_info = $visitors->readAllVisitors();
			
			if(isset($visitors_info)){	

				echo json_encode(['data' => $visitors_info]);		

			}else{		

				echo json_encode(array('statusCode' => 0, 'data' => []));

			}
			
		}
	}
?>
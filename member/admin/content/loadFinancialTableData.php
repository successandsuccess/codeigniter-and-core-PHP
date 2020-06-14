<?php
require_once ("../../config.php");
require_once ("../classes/financial.class.php");
require_once (BASE_PATH . "../classes/database.class.php");

global $db;
$db = new Database();

$financial = new FinancialObject();

$info = $financial->filter_financial_data($_POST);

echo(json_encode($info));
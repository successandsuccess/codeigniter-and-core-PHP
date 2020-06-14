<?php
require_once ("../../config.php");
require_once ("../classes/members.class.php");
require_once (BASE_PATH . "../classes/database.class.php");

global $db;
$db = new Database();

$members = new MembersObject();

$info = $members->filter_user_data($_POST);

echo(json_encode($info));
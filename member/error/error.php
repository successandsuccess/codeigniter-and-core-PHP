<?php
require_once "classes/error.class.php";
global $error;
$error = new ErrorObject();
add_menu( "error", "Error", "../error/admin/ViewAllErrors&li_class=Error" );
?>






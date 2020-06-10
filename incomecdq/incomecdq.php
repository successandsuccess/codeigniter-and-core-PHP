<script src="../plugins/jquery/jquery.min.js"></script>
<?php

require_once "classes/incomecdq.class.php";

global $incomecdq;
$incomecdq = new IncomeCDQObject();

require_once "template/paymentviewcdq.php";

?>
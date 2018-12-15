<?php
include '../include/init.inc.php';
$messageId = "";
extract($_GET,EXTR_IF_EXISTS);
echo json_encode($_POST);
exit;

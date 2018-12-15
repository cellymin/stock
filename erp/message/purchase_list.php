<?php
include '../include/init.inc.php';
$messageId = $action = "";
extract($_GET,EXTR_IF_EXISTS);
$action = $_POST['action'];
if($action=='done'){ //处理库存预警
    if($_POST['messageId']){
        $messageId = implode(',', $_POST['messageId']);
        $ll = Message::purchase_done($messageId);
        echo json_encode($ll);
        exit;
    }
}
$list = Message::purchase_list_info($messageId);
echo '<pre/>';var_dump($list);
die();

Template::assign('list',$list);
Template::assign('page_html',$page_html);
Template::display('message/purchase_list.tpl');
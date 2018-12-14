<?php
include '../include/init.inc.php';
$messageId = "";
extract($_GET,EXTR_IF_EXISTS);

$list = Message::purchase_list_info($messageId);
echo '<pre/>';var_dump($list);
die();

Template::assign('list',$list);
Template::assign('page_html',$page_html);
Template::display('message/purchase_list.tpl');
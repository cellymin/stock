<?php
include '../include/init.inc.php';

$list = array();
$client = new PhalApiClient();
$rs = $client->request('GoodsCate_GetList.Go',$_POST);
if ($client->getRet() == PhalApiClient::RET_OK) { 
    $list = $rs['content'];
}

Template::assign ( 'list', $list );
Template::display('sys/goods_cats.tpl');
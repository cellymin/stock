<?php
include '../include/init.inc.php';

$cateId= "";
extract($_POST,EXTR_IF_EXISTS);


if(Common::isPost()){
	if(!is_array($cateId)){
		Common::exitWithError ('参数错误','sys/goods_cats.php');
	}
	
    //请求接口
    $client = new PhalApiClient();

	$cateId = implode(',',$cateId);

    $rs = $client->request('GoodsCate_Delete.Go',array(
    	'cateId'=>$cateId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'GoodsCate' ,$cateId ,json_encode($cateId));
        Common::exitWithSuccess ('删除成功','sys/goods_cats.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/goods_cats.php');
    }
}
header('location:goods_cats.php');
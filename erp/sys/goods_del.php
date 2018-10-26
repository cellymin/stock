<?php
include '../include/init.inc.php';
$goodsId= "";
extract($_POST,EXTR_IF_EXISTS);


if(Common::isPost()){
	if(!is_array($goodsId)){
		Common::exitWithError ('参数错误','sys/goods.php');
	}
	
    //请求接口
    $client = new PhalApiClient();

	$goodsId = implode(',',$goodsId);

    $rs = $client->request('Goods_Delete.Go',array(
    	'goodsId'=>$goodsId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Goods' ,$goodsId ,json_encode($goodsId));
        Common::exitWithSuccess ('删除成功','sys/goods.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/goods.php');
    }
}
header('location:goods.php');

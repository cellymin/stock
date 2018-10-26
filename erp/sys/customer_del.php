<?php
include '../include/init.inc.php';

$customerId = "";
extract($_POST,EXTR_IF_EXISTS);

if(Common::isPost()){
	if(!is_array($customerId)){
		Common::exitWithError ('参数错误','sys/customer.php');
	}
	
    //请求接口
    $client = new PhalApiClient();

	$customerId = implode(',',$customerId);

    $rs = $client->request('Customer_Delete.Go',array(
    	'customerId'=>$customerId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Customer' ,$customerId ,json_encode($customerId));
        Common::exitWithSuccess ('删除成功','sys/customer.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/customer.php');
    }
}
header('location:customer.php');
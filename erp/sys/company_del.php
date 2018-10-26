<?php
include '../include/init.inc.php';

$companyId = "";
extract($_POST,EXTR_IF_EXISTS);


if(Common::isPost()){
	if(!is_array($companyId)){
		Common::exitWithError ('参数错误','sys/company.php');
	}
	
    //请求接口
    $client = new PhalApiClient();

	$companyId = implode(',',$companyId);

    $rs = $client->request('Company_Delete.Go',array(
    	'companyId'=>$companyId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Company' ,$companyId ,json_encode($companyId));
        Common::exitWithSuccess ('删除成功','sys/company.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/company.php');
    }
}
header('location:company.php');

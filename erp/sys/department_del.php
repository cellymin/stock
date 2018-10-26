<?php
include '../include/init.inc.php';

$departmentId = "";
extract($_POST,EXTR_IF_EXISTS);


if(Common::isPost()){
	if(!is_array($departmentId)){
		Common::exitWithError ('参数错误','sys/department.php');
	}
	
    //请求接口
    $client = new PhalApiClient();

	$departmentId = implode(',',$departmentId);

    $rs = $client->request('Department_Delete.Go',array(
    	'departmentId'=>$departmentId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Department' ,$departmentId ,json_encode($departmentId));
        Common::exitWithSuccess ('删除成功','sys/department.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/department.php');
    }
}
header('location:department.php');

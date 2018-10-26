<<?php
include '../include/init.inc.php';

$employeeId = "";
extract($_POST,EXTR_IF_EXISTS);


if(Common::isPost()){
	if(!is_array($employeeId)){
		Common::exitWithError ('参数错误','sys/employee.php');
	}
	
    //请求接口
    $client = new PhalApiClient();

	$employeeId = implode(',',$employeeId);

    $rs = $client->request('Employee_Delete.Go',array(
    	'employeeId'=>$employeeId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Employee' ,$employeeId ,json_encode($employeeId));
        Common::exitWithSuccess ('删除成功','sys/employee.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/employee.php');
    }
}
header('location:employee.php');

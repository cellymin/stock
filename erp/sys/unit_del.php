<?php
include '../include/init.inc.php';
$unitId = $unitName = "";
extract($_REQUEST,EXTR_IF_EXISTS);

if(Common::isPost()){
	if(!is_array($unitId)){
		Common::exitWithError ('参数错误','sys/unit.php');
	}
	
	//请求接口
	$client = new PhalApiClient();
	$unitId = implode(',',$unitId);

    $rs = $client->request('GoodsUnit_Delete.Go',array(
    	'unitId'=>$unitId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'GoodsUnit' ,$unitId ,json_encode($unitId));
        Common::exitWithSuccess ('删除成功','sys/unit.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/unit.php');
    }
}
header('location:unit.php');

?>
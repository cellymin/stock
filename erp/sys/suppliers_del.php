<?php
include '../include/init.inc.php';
$supplierId = "";
extract($_POST,EXTR_IF_EXISTS);

if(Common::isPost()){
    if(!is_array($supplierId)){
        Common::exitWithError ('参数错误','sys/suppliers.php');
    }

    //请求接口
    $client = new PhalApiClient();

    $supplierId = implode(',',$supplierId);

    $rs = $client->request('Supplier_Delete.Go',array(
        'supplierId'=>$supplierId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Suppliers' ,$supplierId ,json_encode($supplierId));
        Common::exitWithSuccess ('删除成功','sys/suppliers.php');
    } else {
        Common::exitWithError ($client->getMsg(),'sys/suppliers.php');
    }

}
header('location:suppliers.php');
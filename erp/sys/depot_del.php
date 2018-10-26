<?php
include '../include/init.inc.php';

$depotId = "";
extract($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {

    //请求接口
    $client = new PhalApiClient();

    $rs = $client->request('Depot_Delete.Go', array(
        'depotId' => $depotId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Depot', $depotId, json_encode(array('depotId' => $depotId)));
        Common::exitWithSuccess('删除成功', 'sys/depot.php');
    } else {
        Common::exitWithError($client->getMsg(), 'sys/depot.php?depotId='.$depotId);
    }
}
header('location:depot.php');
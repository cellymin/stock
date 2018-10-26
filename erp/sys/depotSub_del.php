<?php
include '../include/init.inc.php';
$depotSubId = $depotId = "";
extract($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    $client = new PhalApiClient();
    $rs = $client->request('DepotSub_Delete.Go', array(
        'depotSubId' => $depotSubId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        SysLog::addLog(UserSession::getUserName(), 'DELETE', 'DepotSub', $depotSubId,
            json_encode(array('depotSubId' => $depotSubId)));
        $_SESSION[UserSession::SESSION_NAME]['formError'] = 1;
    } else {
        $_SESSION[UserSession::SESSION_NAME]['formError'] = $client->getMsg();
    }
    header('Location:depotSub_goods.php?depotId=' . $depotId . '&depotSubId=' . $depotSubId);
}
header('Location:depotSub_goods.php?depotId=' . $depotId . '&depotSubId=' . $depotSubId);
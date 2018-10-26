<?php
include '../include/init.inc.php';
$depotId = "";
extract($_GET, EXTR_IF_EXISTS);

$list = $depotSubs = array();
$client = new PhalApiClient();

$rs = $client->request('Depot_GetList.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $list = $rs['content'];
    $depotId = empty($depotId) ? $list[0]['depotId'] : $depotId;

    $rs = $client->request('DepotSub_GetList.Go', array(
        'depotId' => $depotId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $depotSubs = $rs['content'];
    }
}


Template::assign('list', $list);
Template::assign('depotSubs', $depotSubs);
Template::assign('_GET', $_GET);
Template::display('sys/depot.tpl');
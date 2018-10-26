<?php
include '../include/init.inc.php';
$keyword = $page_no = $type = $depotId = $depotSubId = $orderId = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$list = $depots = $depotSubs = array();
$page_no = $page_no ? $page_no : 1;
$page_html = "";

$client = new PhalApiClient();

if(Common::isPost()){
    $rs = $client->request('DepotSub_Options.Go', array(
        'depotId' => $depotId
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $depotSubs = $rs['content'];
    }
    $depotSubs[0] = '== 请选择库位 ==';
    echo json_encode($depotSubs);
    exit();
}

$rs = $client->request('DepotGoods_GetList.Go', array(
    'keyword'    => $keyword,
    'depotId'    => $depotId,
    'depotSubId' => $depotSubId,
    'page_no'    => $page_no,
    'page_size'  => 7,
));

if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];
    $status = $rs['content']['status'];

    $list = $rs['content']['list'];
    $page_html = Pagination::showPager("goods_search.php?keyword=$keyword&depotId=$depotId&depotSubId=$depotSubId&type=$type",
        $page_no,
        $page_size,
        $row_count);
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}



$orderAddUrl = Common::getOrderAddUrl($type);
if (!$orderAddUrl) {
    Common::closeWithMessage('路径错误', 'error');
}

$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots = $rs['content'];
}
$depots[0] = '== 请选择库位 ==';


Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('depots', $depots);
Template::assign('orderAddUrl', $orderAddUrl);
Template::assign('page_html', $page_html);
Template::display('sales/goods_search.tpl');
<?php
include '../include/init.inc.php';
$keyword  = $page_no = $type = $depotId = $depotSubId = $orderId = $status = $goodsCateId= "";
extract($_GET, EXTR_IF_EXISTS);
$list = $goodsCate = $order = $depotSubs = array();

$page_size = 12;
$page_no=$page_no<1?1:$page_no;
$page_html = "";

$client = new PhalApiClient();
//echo $depotId;die();
$res = $client->request('DepotGoods_GetListNo.Go',array(
    'page_no' => $page_no,
    'page_size' =>$page_size,
    'keyword' => $keyword,
    'depotId' => $depotId,
    'depotSubId' => $depotSubId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    //操作成功处理
    $page_no = $res['content']['page_no'];
    $page_size = $res['content']['page_size'];
    $row_count = $res['content']['row_count'];
    $list = $res['content']['list'];

    $status= $res['content']['status'];
    $page_html=Pagination::showPager("depot_goods_choose.php?keyword=$keyword&depotId=$depotId&depotSubId=$depotSubId",$page_no,$page_size,$row_count);
}
//echo '<pre/>';var_dump($list);die();
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
    $depots_options[0] = '==请选择==';
    ksort($depots_options);
//    echo '<pre/>';var_dump($depots_options);die();
    Template::assign('depots_options', $depots_options);
}
Template::assign('goodsCate', $goodsCate);
//echo '<pre/>';var_dump($list);die();

//echo '<pre/>';var_dump($list);die();
Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('page_html', $page_html);
Template::assign('depotSubId', $depotSubId ? $depotSubId : 0);
Template::assign('page_html', $page_html);
Template::display('storage/depot_goods_choose.tpl');
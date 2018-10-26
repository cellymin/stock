<?php
include '../include/init.inc.php';
$keyword = $goodsCateId = $page_no = $type = "";
extract($_GET, EXTR_IF_EXISTS);
$list      = $goodsCate = array();
$page_no   = $page_no ? $page_no : 1;
$page_html = "";

$client = new PhalApiClient();
$rs     = $client->request('Goods_GetListForOrder.Go', array(
    'type'      => 'PLAN',
    'keyword'   => $keyword,
    'goodsCateId'=>$goodsCateId,
    'page_no'   => $page_no,
    'page_size' => 7,
));

if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no   = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];
    $status    = $rs['content']['status'];

    $list      = $rs['content']['list'];
    $page_html = Pagination::showPager("goods_search.php?keyword=$keyword&goodsCateId=$goodsCateId&type=$type", $page_no, $page_size,
        $row_count);
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}
$rs = $client->request('GoodsCate_GetList.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goodsCate = $rs['content'];
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}

$orderAddUrl = Common::getOrderAddUrl($type);
if(!$orderAddUrl){
    Common::closeWithMessage('路径错误','error');
}

Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('orderAddUrl', $orderAddUrl);
Template::assign('page_html', $page_html);
Template::assign('goodsCate', $goodsCate);
Template::display('purchase/goods_search.tpl');
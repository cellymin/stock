<?php
include '../include/init.inc.php';
$goodsId = $page_no = $supplierId = $sortType = $sortKey = "";
extract($_GET, EXTR_IF_EXISTS);
$list = $suppliers_options = array();
$page_html = '';
$client = new PhalApiClient();

$rs = $client->request('Goods_PriceSearch.Go', array(
    'goodsId'    => $goodsId,
    'page_no'    => $page_no < 1 ? 1 : $page_no,
    'page_size'  => 15,
    'supplierId' => $supplierId,
    'sortType'   => $sortType ? $sortType : 'asc'
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];

    $list = $rs['content']['list'];
    $page_html = Pagination::showPager("price_list.php?goodsId=$goodsId&supplierId=$supplierId&sortType=$sortType",
        $page_no, $page_size, $row_count);
}

$rs = $client->request('Supplier_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $suppliers_options = $rs['content'];
    $suppliers_options[0] = '全部';
}



Template::assign('list', $list);
Template::assign('suppliers_options', $suppliers_options);
Template::assign('page_html', $page_html);
Template::assign('goodsId', $goodsId);
Template::assign('supplierId', $supplierId?$supplierId:0);
Template::assign('sortType', $sortType ? $sortType : 'asc');
Template::assign('page_no', $page_no < 1 ? 1 : $page_no);
Template::display('purchase/price_list.tpl');
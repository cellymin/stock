<?php
include '../include/init.inc.php';
$keyword  = $page_no = $type = $depotId = $depotSubId = $orderId = $status = "";
extract($_GET, EXTR_IF_EXISTS);
$list = $goodsCate = $order = $depotSubs = array();

$page_size = 7;
$page_no=$page_no<1?1:$page_no;
$page_html = "";

$client = new PhalApiClient();
$rs = $client->request('Goods_GetList.Go',array(
    'page_no' => $page_no,
    'page_size' =>999,
    'keyword' => $keyword,
    'goodsCateId' => 0
));
echo '<pre/>';var_dump($rs);die();

//echo '<pre/>';var_dump($list);die();
Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('page_html', $page_html);
Template::assign('depotSubId', $depotSubId ? $depotSubId : 0);
Template::assign('page_html', $page_html);
Template::display('storage/suppliers_choose.tpl');
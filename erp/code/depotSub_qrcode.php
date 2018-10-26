<?php
include '../include/init.inc.php';
$page_no = $keyword = $depotId = "";
extract($_GET,EXTR_IF_EXISTS);

$page_size = PAGE_SIZE;
$page_no = $page_no < 1 ? 1 : $page_no;

$row_count = DepotSub::countCompanyDepotSub($keyword,$depotId);
$total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
$total_page = $total_page < 1 ? 1 : $total_page;
$page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
$start = ($page_no - 1) * $page_size;
$list = DepotSub::getCompanyDepotSub($start, $page_size,$keyword,$depotId);

$page_html = Pagination::showPager("depotSub_qrcode.php", $page_no, $page_size, $row_count);


$client = new PhalApiClient();
$depot_options = array();

$rs = $client->request('Depot_Options.Go',array());
if($client->getRet()==PhalApiClient::RET_OK){
    $depot_options = $rs['content'];
    $depot_options[0] = '全部';
}

Template::assign('list', $list);
Template::assign('depot_options', $depot_options);
Template::assign('page_html', $page_html);
Template::assign('depotId', $depotId?$depotId:0);
Template::assign('_GET', $_GET);
Template::display('code/depotSub_qrcode.tpl');
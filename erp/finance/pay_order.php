<?php
include '../include/init.inc.php';
$page_no = $keyword = $supplierId = $payStatus = "";
extract($_GET, EXTR_IF_EXISTS);

$list = $suppliers_options = array();
$page_html = '';
$payStatus = isset($_GET['payStatus'])?$payStatus:1;
$_GET['payStatus'] = $payStatus;

$client = new PhalApiClient();

$rs = $client->request('Invoice_GetList.Go', array(
    'page_no'    => $page_no ? $page_no : 1,
    'page_size'  => PAGE_SIZE,
    'keyword'    => $keyword,
    'supplierId' => $supplierId,
    'payStatus'  => $payStatus,
    'type'       => 1
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];
    $status = $rs['content']['status'];

    $list = $rs['content']['list'];
    $page_html = Pagination::showPager("plan_order.php?keyword=$keyword&status=$status", $page_no, $page_size,
        $row_count);
}

$rs = $client->request('Supplier_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $suppliers_options = $rs['content'];
}

$suppliers_options[0] = '全部';

Template::assign('page_html', $page_html);
Template::assign('suppliers_options', $suppliers_options);
Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('supplierId', $supplierId ? $supplierId : 0);
Template::display('finance/pay_order.tpl');
<?php
include '../include/init.inc.php';
$invoiceId = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);

$invoice = $order = array();
$page_html = '';
$client = new PhalApiClient();
//$invoiceId = explode(',',$invoiceId);
//获取供应商名称 id 发票id 订单id
$rs = $client->request('Invoice_Get.Go', array(
    'invoiceId' => $invoiceId
));

$rsd = $client->request('Invoice_GetInfo.Go', array(
    'invoiceId' => $invoiceId
));


if ($client->getRet() == PhalApiClient::RET_OK) {
    $goodsList = $rsd['content'];
    $orderNo = $rsd['order'];
    $invoiceInfo = $rs['content'];
    $spanno = $rsd['kk'];
}
$date = date('Y/m/d',time());
$supno =  count($orderNo) + intval($rsd['count']);
unset($rs);
unset($rsd);

Template::assign('date', $date);
Template::assign('supno', $supno);
Template::assign('spanno', $spanno);
Template::assign('invoiceInfo', $invoiceInfo);
Template::assign('orderNo', $orderNo);
Template::assign('_GET', $_GET);
Template::assign('goodsList', $goodsList);
Template::assign('supplierId', $supplierId ? $supplierId : 0);
Template::display('purchase/pay_invoice.tpl');
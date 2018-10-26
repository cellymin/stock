<?php
include '../include/init.inc.php';
$invoiceId = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);

$invoice = $order = array();
$page_html = '';
$client = new PhalApiClient();

$rs = $client->request('Invoice_Get.Go', array(
    'invoiceId' => $invoiceId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $invoice = $rs['content']['invoices'][0];
    $rs = $client->request('Order_Get.Go', array(
        'orderId'   => $invoice['orderId'],
        'type'      => 'PURCHASE_IN',
        'page_no'   => $page_no < 1 ? 1 : $page_no,
        'page_size' => 10
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $page_no   = $rs['content']['goods']['page_no'];
        $page_size = $rs['content']['goods']['page_size'];
        $row_count = $rs['content']['goods']['row_count'];

        $order      = $rs['content'];
        $page_html = Pagination::showPager("invoice_details.php?invoiceId=".$invoiceId, $page_no, $page_size, $row_count);
    }
}

Template::assign('_GET', $_GET);
Template::assign('page_html', $page_html);
Template::assign('invoice', $invoice);
Template::assign('order', $order);
Template::display('purchase/invoice_details.tpl');
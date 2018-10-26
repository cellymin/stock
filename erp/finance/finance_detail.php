<?php
include '../include/init.inc.php';
$financeId = $money = $invoiceImgs = $payStatus = $invoiceStatus = $endTime = $advanceDay = $remark = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$finance = array();
$client = new PhalApiClient();

$rs = $client->request('Finance_Get.Go', array(
    'financeId' => $financeId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $finance = $rs['content'];
    if ($finance['invoiceStatus'] == 0) {
        $advanceDay = date('d', strtotime($finance['endTime']) - strtotime($finance['noticeTime'])) - 1;
    }
}

Template::assign('finance', $finance);
Template::display('finance/finance_details.tpl');
<?php
include '../include/init.inc.php';
$orderId = $type = "";
extract($_POST, EXTR_IF_EXISTS);
$orderId=$orderId[0];
$client = new PhalApiClient();
$rs = $client->request('Order_Change.Go', array(
    'type'      => 'RETURN',
    'orderId'   => $orderId,
));

if ($client->getRet() == PhalApiClient::RET_OK) {
    Common::exitWithMessage('采购退货单生成成功', 'purchase/arrival_order.php');
}else {
    Common::tipWithMessage($client->getMsg(), 'error');
}





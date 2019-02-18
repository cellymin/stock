<?php
include '../include/init.inc.php';
$orderId = $type = "";
extract($_POST, EXTR_IF_EXISTS);
$orderId=$orderId[0];
$client = new PhalApiClient();
$rs = $client->request('Order_Change.Go', array(
    'type'      => 'SALE_RETURN',
    'orderId'   => $orderId,
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    Common::exitWithMessage('销售退货单生成成功', 'sales/index.php');
}else {
    Common::tipWithMessage($client->getMsg(), 'error');
}





<?php
include '../include/init.inc.php';
$orderId = $type = "";
extract($_POST, EXTR_IF_EXISTS);
$orderId=$orderId[0];
$client = new PhalApiClient();
$rs = $client->request('Order_Change.Go', array(
    'type'      => 'USE_OUT',
    'orderId'   => $orderId,
));

if ($client->getRet() == PhalApiClient::RET_OK) {
    Common::exitWithMessage('领用退货单生成成功', 'storage/using_deliver.php');
}else {
    Common::exitWithMessage($client->getMsg(), 'storage/using_deliver.php');
}
<?php
include '../include/init.inc.php';

$orderId = $id = $type = "";
extract($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    if (is_array($id)) {
        $client = new PhalApiClient();

        $rs = $client->request('Order_DeleteGoods.Go', array(
            'type'    => $type,
            'orderId' => $orderId,
            'id'      => implode(',', $id)
        ));

        if ($client->getRet() == PhalApiClient::RET_OK) {
            $_SESSION[UserSession::SESSION_NAME]['formError'] = 1;
        } else {
            $_SESSION[UserSession::SESSION_NAME]['formError'] = $client->getMsg();
        }
        header('location:plan_order_details.php?orderId=' . $orderId);
    }
}

header('location:plan_order_details.php?orderId=' . $orderId);





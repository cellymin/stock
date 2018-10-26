<?php
include '../include/init.inc.php';
$type = $orderId = $nonceStr = $result = $memo = "";
extract($_REQUEST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {

        $client = new PhalApiClient();

        $rs = $client->request('Order_Review.Go', array(
            'type'    => $type,
            'result'  => $result,
            'orderId' => $orderId,
            'memo'    => $memo
        ));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功', 'success');
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


Template::assign('orderId', $orderId);
Template::assign('type', $type);
Template::assign('url', 'review.php');
Template::display('order/review.tpl');
<?php
include '../include/init.inc.php';
$orderId = $type = $reviewer = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$reviewer_options = array();
$client = new PhalApiClient();


if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if (!empty($orderId)
            || in_array($type,
                array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT'))
        ) {

            $rs = $client->request('Order_Save.Go', array(
                'type'     => $type,
                'orderId'  => $orderId,
                'reviewer' => $reviewer
            ));

            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::unsetNonceStr();
                Common::closeWithMessage('操作成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }

        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

$rs = $client->request('Reviewer_Options.Go', array('type' => 'SALE_OUT'));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $reviewer_options = $rs['content'];
}


Template::assign('reviewer_options', $reviewer_options);
Template::assign('orderId', $orderId);
Template::assign('type', 'SALE_OUT');
Template::assign('url', 'to_review.php');
Template::display('order/toReview.tpl');


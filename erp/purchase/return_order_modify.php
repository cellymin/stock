<?php
include '../include/init.inc.php';
$id = $orderId = $goodsCnt = $goodsPrice = $arrivalTime = $remark = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_UpdateGoods.Go', array(
            'id'         => $id,
            'orderId'    => $orderId,
            'goodsCnt'   => $goodsCnt,
            'goodsPrice' => $goodsPrice,
            'remark'     => $remark,
            'type'       => 'RETURN'
        ));

        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('保存成功', 'success', '1200', 0);
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error', '1200');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error', '1200');
    }
}


$rs = $client->request('Order_GetGoods.Go', array(
    'orderId' => $orderId,
    'id'      => $id,
    'type'    => 'RETURN'
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}

Template::assign('goods', $goods);
Template::assign('orderId', $orderId);
Template::assign('id', $id);
Template::display('purchase/return_order_modify.tpl');
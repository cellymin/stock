<?php
include '../include/init.inc.php';
$goodsId = $orderId = $goodsCnt = $goodsPrice = $arrivalTime = $remark = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $suppliers_options = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_InsertGoods.Go', array(
            'goodsId'     => $goodsId,
            'orderId'     => $orderId,
            'goodsCnt'    => $goodsCnt,
            'goodsPrice'  => $goodsPrice,
            'arrivalTime' => $arrivalTime,
            'remark'      => $remark,
            'type'        => 'PLAN'
        ));

        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('保存成功', 'success', '1200', 0);
        } else {
            Common::unsetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error', '1200');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error', '1200');
    }
}

$rs = $client->request('Goods_GetForOrder.Go', array(
    'goodsId' => $goodsId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}

Template::assign('_GET', $_GET);
Template::assign('orderId', $orderId);
Template::assign('goods', $goods);
Template::display('purchase/plan_order_add.tpl');
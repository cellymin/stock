<?php
include '../include/init.inc.php';
$id = $orderId = $goodsCnt = $remark = $nonceStr = $goodsPrice = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_InsertGoods.Go', array(
            'id'           => $id,
            'orderId'      => $orderId,
            'goodsCnt'     => $goodsCnt,
            'goodsPrice'   => $goodsPrice,
            'remark'       => $remark,
            'type'         => 'SALE_OUT'
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

//商品
$rs = $client->request('DepotGoods_Get.Go', array(
    'id' => $id
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}



Template::assign('_GET', $_GET);
Template::assign('orderId', $orderId);
Template::assign('goods', $goods);
Template::display('sales/add.tpl');
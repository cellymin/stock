<?php
include '../include/init.inc.php';
$goodsId = $orderId = $goodsCnt = $goodsPrice = $arrivalTime = $remark = $nonceStr = $supplierId = $depotSubId = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $suppliers_options = $depotSubs_options = $order = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_InsertGoods.Go', array(
            'goodsId'    => $goodsId,
            'orderId'    => $orderId,
            'goodsCnt'   => $goodsCnt,
            'supplierId' => $supplierId,
            'depotSubId' => $depotSubId,
            'goodsPrice' => $goodsPrice,
            'remark'     => $remark,
            'type'       => 'ALLOT_IN'
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

//订单
$rs = $client->request('Order_Get.Go', array(
    'type'      => 'ALLOT_IN',
    'orderId'   => $orderId,
    'page_no'   => 1,
    'page_size' => 1
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $order = $rs['content'];
}
//商品
$rs = $client->request('Goods_GetForOrder.Go', array(
    'goodsId' => $goodsId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}
//供应商
$rs = $client->request('Supplier_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $suppliers_options = $rs['content'];
    $suppliers_options[0] = "== 请选择 ==";
}
//库位
$rs = $client->request('DepotSub_Options.Go', array(
    'depotId' => $order['depotId']
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSubs_options = $rs['content'];
    $depotSubs_options[0] = "== 请选择 ==";
}


Template::assign('_GET', $_GET);
Template::assign('orderId', $orderId);
Template::assign('suppliers_options', $suppliers_options);
Template::assign('depotSubs_options', $depotSubs_options);
Template::assign('goods', $goods);
Template::display('storage/allot_storage_add.tpl');
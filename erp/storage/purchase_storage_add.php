<?php
include '../include/init.inc.php';
$goodsId = $orderId = $goodsCnt = $goodsPrice = $arrivalTime = $remark = $nonceStr = $depotId = $depotSubId = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $depots_options = $depotSubs_options = $order = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_InsertGoods.Go', array(
            'goodsId'    => $goodsId,
            'orderId'    => $orderId,
            'goodsCnt'   => $goodsCnt,
            'depotId'    => $depotId,
            'depotSubId' => $depotSubId,
            'goodsPrice' => $goodsPrice,
            'remark'     => $remark,
            'type'       => 'PURCHASE_IN'
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
    'type'      => 'PURCHASE_IN',
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

//仓库
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
}

//库位
$rs = $client->request('DepotSub_Options.Go', array(
    'depotId' => $depotId ? $depotId : $first_key = key($depots_options)
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSubs_options = $rs['content'];
}
$depotSubs_options[0] = "== 请选择 ==";


Template::assign('_GET', $_GET);
Template::assign('orderId', $orderId);
Template::assign('depots_options', $depots_options);
Template::assign('depotSubs_options', $depotSubs_options);
Template::assign('goods', $goods);
Template::display('storage/purchase_storage_add.tpl');
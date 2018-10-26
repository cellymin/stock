<?php
include '../include/init.inc.php';
$id = $orderId = $goodsCnt = $goodsPrice = $arrivalTime = $remark = $nonceStr = $depotId = $depotSubId = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $depots_options = $depotSubs_options = $order = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_UpdateGoods.Go', array(
            'id'         => $id,
            'orderId'    => $orderId,
            'goodsCnt'   => $goodsCnt,
            'goodsPrice' => $goodsPrice,
            'depotId'    => $depotId,
            'depotSubId' => $depotSubId,
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


$rs = $client->request('Order_GetGoods.Go', array(
    'orderId' => $orderId,
    'id'      => $id,
    'type'    => 'PURCHASE_IN'
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
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

//仓库
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
}

//库位
$rs = $client->request('DepotSub_Options.Go', array(
    'depotId' => $depotId ? $depotId : $goods['depotId']
));

if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSubs_options = $rs['content'];
}
$depotSubs_options[0] = "== 请选择 ==";

Template::assign('goods', $goods);
Template::assign('depots_options', $depots_options);
Template::assign('depotSubs_options', $depotSubs_options);
Template::assign('orderId', $orderId);
Template::assign('depotId', $depotId ? $depotId : 0);
Template::assign('depotSubId', $depotId ? 0 : $goods['depotSubId']);
Template::assign('id', $id);
Template::display('storage/purchase_storage_modify.tpl');
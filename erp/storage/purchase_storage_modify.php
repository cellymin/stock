<?php
include '../include/init.inc.php';
$id = $orderId = $goodsCnt = $goodsPrice = $ratepri = $arrivalTime = $remark = $nonceStr = $depotId = $depotSubId = $costpricec = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $depots_options = $depotSubs_options = $order = array();
$client = new PhalApiClient();
if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if($_POST['costprice']==1){ //不含税价是成本价
            $costprice = $goodsPrice;
        }else if($_POST['costprice']==2){
            $costprice = $goodsPrice;//不含税价
            $goodsPrice = $ratepri;//成本价格
        }
        $rs = $client->request('Order_UpdateGoods.Go', array(
            'id'         => $id,
            'orderId'    => $orderId,
            'goodsCnt'   => $goodsCnt,
            'goodsPrice' => $goodsPrice,//成本价
            'depotId'    => $depotId,
            'depotSubId' => $depotSubId,
            'ratepri' => $ratepri,
            'remark'     => $remark,
            'usecostpri'       => $costprice,//不含税价
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
if($rs['content']['taxrate']){
    $rate = $rs['content']['taxrate'];
    Template::assign('taxrate', $rate);
}
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

if($rate && $goods['goodsPrice']){//不含税价格=含税价/(1+税率)
    if($goods['usecostpri']){
        $hanpri = round((float)$goods['usecostpri']*(1+(float)$rate),2);
        Template::assign('buhanpri', $goods['usecostpri']);
    }else{
        $hanpri = round((float)$goods['goodsPrice']*(1+(float)$rate),2);
        Template::assign('buhanpri', $goods['goodsPrice']);
    }

    Template::assign('hanpri', $hanpri);
}
if($goods['ratepri']){
    if($goods['goodsPrice'] == $goods['ratepri']){//含税价
        Template::assign('usecostpri', 2);
    }else{//不含税价
        Template::assign('usecostpri', 1);
    }
}
Template::assign('goods', $goods);
Template::assign('depots_options', $depots_options);
Template::assign('depotSubs_options', $depotSubs_options);
Template::assign('orderId', $orderId);
Template::assign('depotId', $depotId ? $depotId : $goods['depotId']);
Template::assign('depotSubId', $depotId ? 0 : $goods['depotSubId']);
Template::assign('id', $id);
Template::display('storage/purchase_storage_modify.tpl');
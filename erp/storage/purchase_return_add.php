<?php
include '../include/init.inc.php';
$goodsId = $orderId = $goodsCnt = $goodsPrice = $ratepri = $arrivalTime = $remark = $nonceStr = $depotId = $depotSubId = $costprice= "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $depots_options = $depotSubs_options = $order = array();
$client = new PhalApiClient();
if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        // noratepri 为空 goodsprice 为不含税价格 有值，noratepri为不含税价格
        //noratepri 为空 成本价和不含税价一致为goodpricce
        //noratepri 不为空 成本价和含税价一致标记为 ratepei
        if($_POST['costprice']==1){ //不含税价是成本价
            $costprice = $goodsPrice;
        }else if($_POST['costprice']==2){
            $costprice = $goodsPrice;//不含税价
            $goodsPrice = $ratepri;//成本价格
        }
        $rs = $client->request('Order_InsertGoods.Go', array(
            'goodsId'    => $goodsId,
            'orderId'    => $orderId,
            'goodsCnt'   => $goodsCnt,
            'depotId'    => $depotId,
            'depotSubId' => $depotSubId,
            'goodsPrice' => $goodsPrice,//成本价
            'ratepri' => $ratepri,
            'remark'     => $remark,
            'usecostpri'       => $costprice,//不含税价
            'type'       => 'PURCHASE_RETURN'
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
    'type'      => 'PURCHASE_RETURN',
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
//商品
$str = explode('_',$goodsId);
$goodsId = $str[0];
$lastpri = $str[1];
$nohan = $str[2];//不含税价
if($nohan>0){
    $lastpri = $nohan;
}
$rs = $client->request('Goods_GetForOrder.Go', array(
    'goodsId' => $goodsId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}
//价格
if(empty($lastpri)){
    if($goods['usecostpri']){
        $lastpri = $goods['usecostpri'];
    }else{
        $lastpri = $goods['lastPrice'];
    }
}
if($rate && $lastpri){//不含税价格=含税价/(1+税率)
    $hanpri = round((float)$lastpri*(1+(float)$rate),2);
    Template::assign('hanpri', $hanpri);
}else if($rate && $_GET['lastpri']){
    $lastpri = $_GET['lastpri'];
    $hanpri = round((float)$lastpri*(1+(float)$rate),2);
    Template::assign('hanpri', $hanpri);
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
Template::assign('lastprice', $lastpri);
Template::display('storage/purchase_storage_add.tpl');
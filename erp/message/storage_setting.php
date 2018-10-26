<?php
include '../include/init.inc.php';
$depotId = $depotSubId = $goodsCateId = $goodsId = $minWarnNum = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
$depot_options = $depotSub_options = $goods_cates = $goods_options = array();

if(Common::isPost()){
    if($nonceStr==$_SESSION[UserSession::SESSION_NAME]['form_nonceStr']){
        if(MsgSetting::setGoodsIsExists($depotSubId,$goodsId)){
            $id = MsgSetting::setGoods($depotId,$depotSubId,$goodsCateId,$goodsId,$minWarnNum);
            if($id){
                Common::unsetNonceStr();
                SysLog::addLog ( UserSession::getUserName(), 'ADD', 'MsgSetting' ,$id, json_encode(array(
                    'depotId'=>$depotId,
                    'depotSubId'=>$depotSubId,
                    'goodsCateId'=>$goodsCateId,
                    'goodsId'=>$goodsId,
                    'minWarnNum'=>$minWarnNum,
                )));
                Common::closeWithMessage('保存成功','success');
            }else{
                Common::resetNonceStr();
                Common::closeWithMessage('保存失败','error');
            }
        }else{
            Common::resetNonceStr();
            Common::closeWithMessage('当前公司已存在相同库位相同商品预警设置','error');
        }
    }else{
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效','error');
    }
}

$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depot_options = $rs['content'];
}

$rs = $client->request('DepotSub_Options.Go', array('depotId' => $depotId ? $depotId : key($depot_options)));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSub_options = $rs['content'];
}

$rs = $client->request('GoodsCate_GetList.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods_cates = $rs['content'];
}

if(!$goodsCateId && !empty($goods_cates)){
    $goodsCateId = $goods_cates[0]['cateId'];
}

$rs = $client->request('Goods_Options.Go', array('goodsCateId' => $goodsCateId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods_options = $rs['content'];
}

Template::assign('_GET',$_GET);
Template::assign('depot_options', $depot_options);
Template::assign('depotSub_options', $depotSub_options);
Template::assign('goods_cates', $goods_cates);
Template::assign('goods_options', $goods_options);
Template::display('message/storage_setting.tpl');
<?php
include '../include/init.inc.php';
$id = $depotId = $depotSubId = $goodsCateId = $goodsId = $minWarnNum = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
$depot_options = $depotSub_options = $goods_cates = $goods_options = $set = array();

//设置详情
$set = MsgSetting::getSetGoods($id);

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if($_SESSION[UserSession::SESSION_NAME]['user_group']==1 || $set['createCompany']==$_SESSION[UserSession::SESSION_NAME]['companyId']){
            if((($set['depotSubId']!=$depotSubId || $set['goodsId']!=$goodsId) && MsgSetting::setGoodsIsExists($depotSubId,$goodsId)) || ($set['depotSubId']==$depotSubId && $set['goodsId']==$goodsId)){
                $input = array(
                    'depotId'     => $depotId,
                    'depotSubId'  => $depotSubId,
                    'goodsCateId' => $goodsCateId,
                    'goodsId'     => $goodsId,
                    'minWarnNum'  => $minWarnNum,
                );
                if (MsgSetting::editSetGoods($id, $input)!==false) {
                    Common::unsetNonceStr();
                    SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'MsgSetting' ,$id, json_encode($input));
                    Common::closeWithMessage('保存成功', 'success');
                } else {
                    Common::resetNonceStr();
                    Common::tipWithMessage('保存失败', 'error');
                }
            }else{
                Common::unsetNonceStr();
                Common::closeWithMessage('当前公司已存在相同库位相同商品预警设置', 'error');
            }
        }else{
            Common::unsetNonceStr();
            Common::closeWithMessage('不能操作其他公司的设置', 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

//options
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depot_options = $rs['content'];
}

$rs = $client->request('DepotSub_Options.Go', array('depotId' => $depotId ? $depotId : $set['depotId']));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSub_options = $rs['content'];
}

$rs = $client->request('GoodsCate_GetList.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods_cates = $rs['content'];
}

if (!$goodsCateId && !empty($goods_cates)) {
    $goodsCateId = $set['goodsCateId'];
}

$rs = $client->request('Goods_Options.Go', array('goodsCateId' => $goodsCateId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods_options = $rs['content'];
}

Template::assign('_GET', $_GET);
Template::assign('set', $set);
Template::assign('goodsCateId', $goodsCateId);
Template::assign('depotId', $depotId ? $depotId : $set['depotId']);
Template::assign('depot_options', $depot_options);
Template::assign('depotSub_options', $depotSub_options);
Template::assign('goods_cates', $goods_cates);
Template::assign('goods_options', $goods_options);
Template::display('message/storage_modify.tpl');
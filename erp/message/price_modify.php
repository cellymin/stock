<?php
include '../include/init.inc.php';
$id = $goodsCateId = $goodsId = $upPercent = $downPercent = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
$depot_options = $depotSub_options = $goods_cates = $goods_options = $set = array();

//设置详情
$set = MsgSetting::getSetPrice($id);

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if($_SESSION[UserSession::SESSION_NAME]['user_group']==1 || $set['createCompany']==$_SESSION[UserSession::SESSION_NAME]['companyId']){
            if(($set['goodsId']!=$goodsId && MsgSetting::setPriceIsExists($goodsId)) || $set['goodsId']==$goodsId){
                $input = array(
                    'goodsCateId' => $goodsCateId,
                    'goodsId'     => $goodsId,
                    'upPercent'   => $upPercent,
                    'downPercent' => $downPercent,
                );
                if (MsgSetting::editSetPrice($id, $input)!==false) {
                    Common::unsetNonceStr();
                    SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'MsgSetting' ,$id, json_encode($input));
                    Common::closeWithMessage('保存成功', 'success');
                } else {
                    Common::resetNonceStr();
                    Common::tipWithMessage('保存失败', 'error');
                }
            }else{
                Common::unsetNonceStr();
                Common::closeWithMessage('当前公司已存在相同商品预警设置', 'error');
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
Template::assign('goods_cates', $goods_cates);
Template::assign('goods_options', $goods_options);
Template::display('message/price_modify.tpl');
<?php
include '../include/init.inc.php';
$goodsCateId = $goodsId = $upPercent = $downPercent = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods_options = $goods_cates = array();
// error_log(print_r(1,1));
if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if (MsgSetting::setPriceIsExists($goodsId)) {
            $id = MsgSetting::setPrice($goodsCateId, $goodsId, $upPercent,$downPercent);
            if ($id) {
                Common::unsetNonceStr();
                SysLog::addLog(UserSession::getUserName(), 'ADD', 'MsgSetting', $id, json_encode(array(
                    'goodsCateId' => $goodsCateId,
                    'goodsId'     => $goodsId,
                    'upPercent'   => $upPercent,
                    'downPercent' => $downPercent,
                )));
                Common::closeWithMessage('保存成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage('保存失败', 'error');
            }
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage('当前公司存在相同产品的价格预警设置', 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

$client = new PhalApiClient();

$rs = $client->request('GoodsCate_GetList.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods_cates = $rs['content'];
}

if (!$goodsCateId && !empty($goods_cates)) {
    $goodsCateId = $goods_cates[0]['cateId'];
}

$rs = $client->request('Goods_Options.Go', array('goodsCateId' => $goodsCateId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods_options = $rs['content'];

}


Template::assign('_GET', $_GET);
Template::assign('goods_cates', $goods_cates);
Template::assign('goods_options', $goods_options);
Template::display('message/price_setting.tpl');
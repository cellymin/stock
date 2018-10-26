<?php
include '../include/init.inc.php';
$goodsBarCode = $goodsName = $goodsSpec = $goodsCateId1 = $goodsCateId2 = $goodsCateId = $goodsUnitId =
$productionDate = $invalidDate = $searchKey = $remark = $nonceStr = $method = $parentId = "";
extract($_POST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
//分类
$cateList = array();
//计量单位
$unitList = array();

//条形码
$code = '';

if (Common::isPost()) {
    if ($method == 'opt') {
        $list = array();
        $rs = $client->request('GoodsCate_Options.Go', array('parentId' => $parentId));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $list = $rs['content'];
        }
        echo json_encode($list);
        exit;
    } else {
        if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
            $res = $client->request('Goods_Insert.Go', $_POST);
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::closeWithMessage('操作成功');
                Common::unsetNonceStr();
                SysLog::addLog(UserSession::getUserName(), 'ADD', 'Goods', $rs['goodsId'], json_encode($_POST));
                $_POST = null;
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::unsetNonceStr();
            Common::closeWithMessage('表单已失效','error');
        }
    }

}

$rs = $client->request('GoodsUnit_Options.Go', $_POST);
if ($client->getRet() == PhalApiClient::RET_OK) {
    $unitList = $rs['content'];
}

$rs = $client->request('Goods_GetCode.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $code = $rs['content'];
}

Template::assign('unitList', $unitList);
Template::assign('cateList', $cateList);
Template::assign('code', $code);
Template::assign('_POST', $_POST);
Template::display('sys/goods_add.tpl');
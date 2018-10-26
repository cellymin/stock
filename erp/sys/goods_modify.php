<?php
include '../include/init.inc.php';

$goodsId = $goodsSn = $goodsName = $goodsSpec = $goodsCateId1 = $goodsCateId2 = $goodsCateId =
$goodsUnitId =
$productionDate = $invalidDate = $searchKey = $remark = $nonceStr = $method = $parentId = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$goods = $cateList = $unitList = array();
$client = new PhalApiClient();

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
            $input = array();
            $input['goodsId'] = $goodsId;
            $input['goodsSn'] = $goodsSn;
            $input['goodsName'] = $goodsName;
            $input['goodsSpec'] = $goodsSpec;
            $input['goodsCateId1'] = $goodsCateId1;
            $input['goodsCateId2'] = $goodsCateId2;
            $input['goodsCateId'] = $goodsCateId;
            $input['goodsUnitId'] = $goodsUnitId;
            $input['productionDate'] = $productionDate;
            $input['invalidDate'] = $invalidDate;
            $input['searchKey'] = $searchKey;
            $input['remark'] = $remark;

            $res = $client->request('Goods_Update.Go', $input);
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::closeWithMessage('操作成功');
                Common::unsetNonceStr();
                SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Goods', $goodsId, json_encode($input));
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

$res = $client->request('Goods_Get.Go', array('goodsId' => $goodsId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $res['content'];

    //计量单位
    $rs = $client->request('GoodsUnit_Options.Go', $_POST);
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $unitList = $rs['content'];
    }

} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


Template::assign('unitList', $unitList);
Template::assign('cateList', $cateList);
Template::assign('goods', $goods);
Template::display('sys/goods_modify.tpl');
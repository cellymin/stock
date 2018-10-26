<?php
include '../include/init.inc.php';
$cateId = $goodsCateId1 = $goodsCateId2 = $parentId = $cateName = $cateSort = $nonceStr = $cateNo = $method = '';
extract($_REQUEST, EXTR_IF_EXISTS);

//商品上一级分类
$list = $info = $goods_cats = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if($method=='opt'){
        $rs = $client->request('GoodsCate_Options.Go', array('parentId'=>$parentId));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $list = $rs['content'];
        }
        echo json_encode($list);
        exit;
    }else{
        if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
            //请求接口
            $input = array(
                'cateId'   => $cateId,
                'parentId' => $goodsCateId2 != 0 ? $goodsCateId2 : $goodsCateId1,
                'cateName' => $cateName,
                'cateSort' => $cateSort,
                'cateNo'   => $cateNo,
            );
            $rs = $client->request('GoodsCate_Update.Go', $input);
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::closeWithMessage('操作成功');
                Common::unsetNonceStr();
                SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'GoodsCate', $companyId, json_encode($input));
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

$rs = $client->request('GoodsCate_Get.Go', array('cateId' => $cateId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $info = $rs['content'];
}

//var_dump($info);

Template::assign('list', $list);
Template::assign('info', $info);
Template::display('sys/goods_cats_modify.tpl');
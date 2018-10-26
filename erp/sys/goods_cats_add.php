<?php
include '../include/init.inc.php';
$parentId = $goodsCateId1 = $goodsCateId2 = $cateName = $cateSort = $nonceStr = $cateNo = $method = '';

extract($_POST, EXTR_IF_EXISTS);

//商品上一级分类
$list = array();
$client = new PhalApiClient();


//提交保存
if (Common::isPost()) {
    if ($method == 'opt') {
        $rs = $client->request('GoodsCate_Options.Go', array('parentId' => $parentId));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $list = $rs['content'];
        }
        echo json_encode($list);
        exit;
    } else {
        if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {

            $input_data = array();
            $input_data['parentId'] = $goodsCateId2 != 0 ? $goodsCateId2 : $goodsCateId1;
            $input_data['cateName'] = $cateName;
            $input_data['cateSort'] = $cateSort;
            $input_data['cateNo'] = $cateNo;

            $rs = $client->request('GoodsCate_Insert.Go', $input_data);
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::closeWithMessage('操作成功');
                Common::unsetNonceStr();
                SysLog::addLog(UserSession::getUserName(), 'ADD', 'GoodsCats', $rs['cateId'], json_encode($input_data));
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::unsetNonceStr();
            Common::closeWithMessage('表单已失效', 'error');
        }
    }
}


Template::assign('list', $list);
Template::display('sys/goods_cats_add.tpl');
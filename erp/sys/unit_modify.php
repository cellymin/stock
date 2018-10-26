<?php
include '../include/init.inc.php';
$unitId = $unitName = $nonceStr = $unitNo = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$unit = array();

if (Common::isPost()) {
    //请求接口
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $input = array(
            'unitId'   => $unitId,
            'unitName' => $unitName,
            'unitNo' =>$unitNo
        );

        $rs = $client->request('GoodsUnit_Update.Go', $input);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'GoodsUnit',
                $unitId, json_encode($input));
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


$rs = $client->request('GoodsUnit_Get.Go', array('unitId' => $unitId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $unit = $rs['content'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


Template::assign('unit', $unit);
Template::display('sys/unit_modify.tpl');
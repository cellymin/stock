<?php
include '../include/init.inc.php';

$companyId = $companyName = $companyAddress = $companyTel = $companyUserName =
$companyUserPhone = $companyUserEmail = $companyUserQQ = $nonceStr = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
$company = array();

if (Common::isPost()) {
    //请求接口
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $input = array(
            'companyId'        => $companyId,
            'companyName'      => $companyName,
            'companyAddress'   => $companyAddress,
            'companyTel'       => $companyTel,
            'companyUserName'  => $companyUserName,
            'companyUserPhone' => $companyUserPhone,
            'companyUserEmail' => $companyUserEmail,
            'companyUserQQ'    => $companyUserQQ,
        );

        $rs = $client->request('Company_Update.Go', $input);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Company',
                $companyId, json_encode($input));
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


$rs = $client->request('Company_Get.Go', array('companyId' => $companyId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company = $rs['content'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


Template::assign("company", $company);
Template::display('sys/company_modify.tpl');
<?php
include '../include/init.inc.php';

$companyName = $companyAddress = $companyTel = $companyUserName =
$companyUserPhone = $companyUserEmail = $companyUserQQ = $nonceStr = '';
extract($_POST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$list = array();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        //请求接口
        $rs = $client->request('Company_Insert.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'Company', $rs['companyId'], json_encode($_POST));
            Template::assign("_POST", array());
        } else {
            Common::resetNonceStr();
            Template::assign("_POST", $_POST);
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


//分类列表
$rs = $client->request('GoodsCate_GetList.Go', $_POST);
if ($client->getRet() == PhalApiClient::RET_OK) {
    $list = $rs['content'];
}


Template::assign("list", $list);
Template::display('sys/company_add.tpl');
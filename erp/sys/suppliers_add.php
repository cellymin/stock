<?php
include '../include/init.inc.php';
$supplierName = $supplierAddress = $supplierTel = $supplierUserName =
$supplierUserPhone = $supplierUserEmail = $supplierUserQQ = $bankName =
$bankAccount = $bankOpenName =
$cardUserName =
$cardUserPhone = $cardMoney = $remark = $reviewer = $nonceStr = '';
extract($_POST, EXTR_IF_EXISTS);
//获取审核人
$reviewer_options = array();
//请求接口
$client = new PhalApiClient();


if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Supplier_Insert.Go', $_POST);

        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::closeWithMessage('操作成功');
            Common::unsetNonceStr();
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'Supplier',
                $rs['supplierId'], json_encode($_POST));
            Template::assign("_POST", array());
        } else {
            Common::resetNonceStr();
            Template::assign("_POST", $_POST);
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效','error');
    }
}

$rs = $client->request('Reviewer_Options.Go', array('type' => 'supplier'));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $reviewer_options = $rs['content'];
}


Template::assign('reviewer_options', $reviewer_options);
Template::display('sys/suppliers_add.tpl');
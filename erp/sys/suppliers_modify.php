<?php
include '../include/init.inc.php';
$supplierId = $nonceStr = '';
extract($_REQUEST, EXTR_IF_EXISTS);
$supplier = $reviewer_options = array();
$client = new PhalApiClient();


if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Supplier_Update.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Suppliers',
                $supplierId, json_encode($_POST));
            Common::closeWithMessage('保存成功', 'success');
            Common::unsetNonceStr();
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

$rs = $client->request('Supplier_Get.Go', array('supplierId' => $supplierId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $supplier = $rs['content'];
}

$rs = $client->request('Reviewer_Options.Go', array('type' => 'supplier'));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $reviewer_options = $rs['content'];
}


Template::assign('reviewer_options', $reviewer_options);
Template::assign('supplier', $supplier);
Template::display('sys/suppliers_modify.tpl');
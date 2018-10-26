<?php
include '../include/init.inc.php';
$customerName = $customerAddress =
$customerUserName = $customerUserPhone = $customerUserEmail = $nonceStr = '';
extract($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {

        $client = new PhalApiClient();

        $rs = $client->request('Customer_Insert.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'Customer', $rs['customerId'], json_encode($_POST));
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

Template::display('sys/customer_add.tpl');
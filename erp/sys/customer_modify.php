<?php
include '../include/init.inc.php';
$customerId = $customerName = $customerAddress =
$customerUserName = $customerUserPhone = $customerUserEmail = $nonceStr = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$customer = array();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        //请求接口
        $input = array();
        $input['customerId'] = $customerId;
        $input['customerName'] = $customerName;
        $input['customerAddress'] = $customerAddress;
        $input['customerUserName'] = $customerUserName;
        $input['customerUserPhone'] = $customerUserPhone;
        $input['customerUserEmail'] = $customerUserEmail;

        $rs = $client->request('Customer_Update.Go', $input);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Customer', $customerId, json_encode($input));
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


$rs = $client->request('Customer_Get.Go', array('customerId' => $customerId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $customer = $rs['content'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


Template::assign('customer', $customer);
Template::display('sys/customer_modify.tpl');
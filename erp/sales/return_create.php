<?php
include '../include/init.inc.php';
$customerId = $nonceStr = $remark = "";
extract($_POST, EXTR_IF_EXISTS);
$customers_options = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if ($customerId != 0) {
            $rs = $client->request('Order_Create.Go', array(
                'type'       => 'SALE_RETURN',
                'remark'      => $remark,
                'customerId' => $customerId
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::unsetNonceStr();
                Common::closeWithMessage('新建成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::tipWithMessage('请选择客户', 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

$rs = $client->request('Customer_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $customers_options = $rs['content'];
    $customers_options[0] = "== 请选择 ==";
}

Template::assign('form_url', 'return_create.php');
Template::assign('type', '1');
Template::assign('role','1');
Template::assign('customers_options', $customers_options);
Template::display('order/create.tpl');
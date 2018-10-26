<?php
include '../include/init.inc.php';
$customerId = $nonceStr = $remark = $deliverTime = "";
extract($_POST, EXTR_IF_EXISTS);
$customer_options = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if ($customerId != 0) {
            $rs = $client->request('Order_Create.Go', array(
                'type'        => 'SALE_OUT',
                'customerId'  => $customerId,
                'remark'      => $remark,
                'deliverTime' => $deliverTime,
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
    $customer_options = $rs['content'];
    $customer_options[0] = "== 请选择 ==";
}


Template::assign('form_url', 'create.php');
Template::assign('type', '3');
Template::assign('customer_options', $customer_options);
Template::display('order/create.tpl');
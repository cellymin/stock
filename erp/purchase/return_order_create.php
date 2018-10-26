<?php
include '../include/init.inc.php';
$supplierId = $nonceStr = $remark = "";
extract($_POST, EXTR_IF_EXISTS);
$suppliers_options = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if ($supplierId != 0) {
            $rs = $client->request('Order_Create.Go', array(
                'type'       => 'RETURN',
                'remark'      => $remark,
                'supplierId' => $supplierId
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::unsetNonceStr();
                Common::closeWithMessage('新建成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::tipWithMessage('请选择供应商', 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}

$rs = $client->request('Supplier_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $suppliers_options = $rs['content'];
    $suppliers_options[0] = "== 请选择 ==";
}

Template::assign('form_url', 'return_order_create.php');
Template::assign('type', '1');
Template::assign('suppliers_options', $suppliers_options);
Template::display('order/create.tpl');
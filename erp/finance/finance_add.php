<?php
include '../include/init.inc.php';
$type = $cate = $money = $remark = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$list = array();


$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Finance_Insert.Go', array(
            'money'      => $money,
            'remark'     => $remark,
            'type'       => $type,
            'cate'       => $cate
        ));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('保存成功', 'success');
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}



Template::assign('list', $list);
Template::assign('invoiceId', $invoiceId);
Template::display('finance/finance_add.tpl');
<?php
include '../include/init.inc.php';
$invoiceId = $invoiceImgs = $invoiceStatus = $endTime = $noticeTime = $remark = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$list = array();

if (!empty($invoiceId)) {
    $client = new PhalApiClient();

    if (Common::isPost()) {
        if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
            $rs = $client->request('Invoice_Collect.Go', array(
                'invoiceId'     => $invoiceId,
                'invoiceImg'   => $invoiceImgs,
                'invoiceStatus' => $invoiceStatus,
                'endTime'       => $endTime,
                'noticeTime'    => $noticeTime,
                'remark'        => $remark,
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::unsetNonceStr();
                Common::closeWithMessage('操作成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::unsetNonceStr();
            Common::closeWithMessage('表单已失效', 'error');
        }
    }

    $rs = $client->request('Invoice_Get.Go', array(
        'invoiceId' => $invoiceId
    ));

    if ($client->getRet() == PhalApiClient::RET_OK) {
        $list = $rs['content'];
    } else {
        Common::closeWithMessage($client->getMsg(), 'error');
    }
} else {
    Common::closeWithMessage('参数错误', 'error');
}


Template::assign('list', $list);
Template::assign('invoiceId', $invoiceId);
Template::display('finance/pay_collect.tpl');
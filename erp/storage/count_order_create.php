<?php
include '../include/init.inc.php';
$depotId = $nonceStr = $remark = "";
extract($_POST, EXTR_IF_EXISTS);
$depots_options = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        if ($depotId != 0) {
            $rs = $client->request('Order_Create.Go', array(
                'type'    => 'INVENTORY',
                'remark'      => $remark,
                'depotId' => $depotId
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                Common::unsetNonceStr();
                Common::closeWithMessage('新建成功', 'success');
            } else {
                Common::resetNonceStr();
                Common::tipWithMessage($client->getMsg(), 'error');
            }
        } else {
            Common::tipWithMessage('请选择仓库', 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('无效的表单', 'error');
    }

}

$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
    $depots_options[0] = "== 请选择 ==";
}

Template::assign('form_url', 'count_order_create.php');
Template::assign('type', '2');
Template::assign('depots_options', $depots_options);
Template::display('order/create.tpl');
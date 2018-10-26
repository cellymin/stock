<?php
include '../include/init.inc.php';
$depotSubId = $nonceStr = $depotId = $depotSubName = $depotSubNo = $companyId = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();
$depotSub = $company_options = array();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('DepotSub_Update.Go', array(
            'depotSubId'   => $depotSubId,
            'depotId'      => $depotId,
            'depotSubName' => $depotSubName,
            'depotSubNo'   => $depotSubNo,
            'companyId'    => $companyId
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


$rs = $client->request('DepotSub_Get.Go', array('depotSubId' => $depotSubId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSub = $rs['content'];
}

//公司
$rs = $client->request('Company_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
}


Template::assign('company_options', $company_options);
Template::assign('depotSub', $depotSub);
Template::assign('_GET', $_GET);
Template::display('sys/depotSub_modify.tpl');
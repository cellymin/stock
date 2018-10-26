<?php
include '../include/init.inc.php';
$depotId = $depotSubName = $companyId = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$company_options = array();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('DepotSub_Insert.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'DepotSub', $rs['depotSubId'],
                json_encode(array(
                    'depotId'      => $depotId,
                    'depotSubId'   => $rs['depotSubId'],
                    'depotSubName' => $depotSubName,
                    'companyId'    => $companyId
                )));
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

//公司
$rs = $client->request('Company_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
}

Template::assign('company_options', $company_options);
Template::assign('_GET', $_GET);
Template::display('sys/depotSub_add.tpl');
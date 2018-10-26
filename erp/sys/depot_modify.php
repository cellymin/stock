<?php
include '../include/init.inc.php';
$depotId = $depotName = $employeeId = $isDefault = $companyId = $departmentId = $nonceStr = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$company_options = array();
$employee_options = array();
$department_options = array();
$depot = array();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Depot_Update.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'Depot', $rs['depotId'], json_encode($_POST));
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

//仓库
$rs = $client->request('Depot_Get.Go', array('depotId' => $depotId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depot = $rs['content'];
}


//公司
$rs = $client->request('Company_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
}
//部门
$rs = $client->request('Department_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $department_options = $rs['content'];
}
//负责人
$rs = $client->request('Employee_Options.Go', array(
    'companyId'    => $companyId,
    'departmentId' => $departmentId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    foreach ($rs['content'] as $row) {
        $employee_options[$row['employeeId']] = $row['employeeName'];
    }
}

$companyId = empty($companyId) ? $depot['companyId'] : $companyId;
$departmentId = empty($departmentId) ? $depot['departmentId'] : $departmentId;
$employeeId = empty($employeeId) ? $depot['employeeId'] : $employeeId;


Template::assign('depot', $depot);
Template::assign('company_options', $company_options);
Template::assign('department_options', $department_options);
Template::assign('employee_options', $employee_options);
Template::assign('companyId', $companyId);
Template::assign('departmentId', $departmentId);
Template::assign('employeeId', $employeeId);
Template::display('sys/depot_modify.tpl');
<?php
include '../include/init.inc.php';

$companyId = $employeeId = $departmentId = $employeeName = $employeeAddress =
$employeePhone = $employeeEmail = $employeeQQ = $employeeJob = $nonceStr = '';
extract($_POST, EXTR_IF_EXISTS);
//请求接口
$client = new PhalApiClient();

$company_options = array();
$department_options = array();


if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Employee_Insert.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::closeWithMessage('操作成功');
            Common::unsetNonceStr();
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'Employee', $rs['employeeId'], json_encode($_POST));
            Template::assign("_POST", array());
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
            Template::assign("_POST", $_POST);
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


$rs = $client->request('Company_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    unset($company_options[0]);
}

$rs = $client->request('Department_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $department_options = $rs['content'];
    unset($department_options[0]);
}


Template::assign("company_options", $company_options);
Template::assign("department_options", $department_options);
Template::display('sys/employee_add.tpl');
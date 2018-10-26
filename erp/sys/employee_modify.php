<?php
include '../include/init.inc.php';

$employeeId = $companyId = $departmentId = $employeeName = $employeeAddress =
$employeePhone = $employeeEmail = $employeeQQ = $employeeJob = $nonceStr = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$company_options = array();
$department_options = array();
$employee = array();


if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $input = array();
        $input['employeeId'] = $employeeId;
        $input['companyId'] = $companyId;
        $input['departmentId'] = $departmentId;
        $input['employeeName'] = $employeeName;
        $input['employeeAddress'] = $employeeAddress;
        $input['employeePhone'] = $employeePhone;
        $input['employeeEmail'] = $employeeEmail;
        $input['employeeQQ'] = $employeeQQ;
        $input['employeeJob'] = $employeeJob;


        $rs = $client->request('Employee_Update.Go', $input);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Employee',
                $employeeId, json_encode($input));
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


//公司下拉列表
$rs = $client->request('Company_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    unset($company_options[0]);
}
//部门下拉列表
$rs = $client->request('Department_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $department_options = $rs['content'];
    unset($department_options[0]);

}
//员工资料
$rs = $client->request('Employee_Get.Go', array('employeeId' => $employeeId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $employee = $rs['content'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


Template::assign("company_options", $company_options);
Template::assign("department_options", $department_options);
Template::assign("employee", $employee);
Template::display('sys/employee_modify.tpl');
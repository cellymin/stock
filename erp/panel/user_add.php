<?php
require('../include/init.inc.php');
$user_name = $real_name = $mobile = $password = $email = $user_desc = $user_group = $companyId = $departmentId = $employeeId = $selectAll = $method = '';
extract($_POST, EXTR_IF_EXISTS);
$company_options = $department_options = $employee_options = array();
$client          = new PhalApiClient();

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

if (Common::isPost()) {
    if ($method == 'getEmployee') {
        $rs = $client->request('Employee_Options.Go', array(
            'companyId'    => $companyId,
            'departmentId' => $departmentId
        ));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $employee_options = $rs['content'];
        }

        echo json_encode($employee_options);
        exit();
    }

    $exist = User::getUserByName($user_name);
    if ($exist) {

        OSAdmin::alert("error", ErrorMessage::NAME_CONFLICT);
    } else if ($password == "" || $real_name == "" || $mobile == "" || $email == "" || $user_group <= 0 || empty($companyId) || empty($departmentId) || empty($employeeId)) {

        OSAdmin::alert("error", ErrorMessage::NEED_PARAM);
    } else {
        $input_data = array(
            'user_name' => $user_name,
            'password' => md5($password),
            'real_name' => $real_name,
            'mobile' => $mobile,
            'email' => $email,
            'user_desc' => $user_desc,
            'user_group' => $user_group,
            'companyId'=>$companyId,
            'departmentId'=>$departmentId,
            'employeeId'=>$employeeId,
            'selectAll'=>$selectAll
        );
        $user_id    = User::addUser($input_data);

        if ($user_id) {
            $input_data['password'] = "";
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'User', $user_id, json_encode($input_data));
            Common::exitWithSuccess('账号添加成功', 'panel/users.php');
        } else {
            OSAdmin::alert("error");
        }
    }
}
$group_options = UserGroup::getGroupForOptions();
Template::assign("_POST", $_POST);
Template::assign('company_options', $company_options);
Template::assign('department_options', $department_options);
Template::assign('employee_options', $employee_options);
Template::assign('group_options', $group_options);
Template::display('panel/user_add.tpl');

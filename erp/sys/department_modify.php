<?php
include '../include/init.inc.php';

$departmentId = $departmentName = $remark = $nonceStr = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$client = new PhalApiClient();

$department = array();


if (Common::isPost()) {
    //请求接口
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $input = array(
            'departmentId'   => $departmentId,
            'departmentName' => $departmentName,
            'remark'         => $remark,
        );

        $rs = $client->request('Department_Update.Go', $input);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Department', $departmentId, json_encode($input));
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error');
    }
}


$rs = $client->request('Department_Get.Go', array('departmentId' => $departmentId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $department = $rs['content'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


Template::assign("department", $department);
Template::display('sys/department_modify.tpl');
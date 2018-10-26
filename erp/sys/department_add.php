<?php
include '../include/init.inc.php';

$departmentId = $departmentName = $remark = $nonceStr = '';
extract($_POST, EXTR_IF_EXISTS);


if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        //请求接口
        $client = new PhalApiClient();

        $rs = $client->request('Department_Insert.Go', $_POST);
        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('操作成功');
            SysLog::addLog(UserSession::getUserName(), 'ADD', 'DEPARTMENT',
                $rs['departmentId'], json_encode($_POST));
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

Template::display('sys/department_add.tpl');
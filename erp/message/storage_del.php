<?php
include '../include/init.inc.php';
$id = "";
extract($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    $set = MsgSetting::getSetGoods($id);
    if (!$set) {
        Common::exitWithError('设置不存在', 'message/storage_sets.php');
    }
    if ($_SESSION[UserSession::SESSION_NAME]['user_group'] == 1 || $set['createCompany'] == $_SESSION[UserSession::SESSION_NAME]['companyId']) {
        if (MsgSetting::editSetGoods($id, array('flag' => -1)) !== false) {
            SysLog::addLog(UserSession::getUserName(), 'DELETE', 'MsgSetting', $id, json_encode(array('flag' => -1)));
            Common::exitWithSuccess('删除成功', 'message/storage_sets.php');
        }
        Common::exitWithSuccess('删除失败', 'message/storage_sets.php');
    }
    Common::exitWithSuccess('不能操作其他公司的设置', 'message/storage_sets.php');
}
header('Location:/index.php');
<?php
include '../include/init.inc.php';
$id = $orderId = $goodsCnt = $remark = $nonceStr = $departmentId = $employeeId = $method = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = array();
$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_UpdateGoods.Go', array(
            'id'           => $id,
            'orderId'      => $orderId,
            'goodsCnt'     => $goodsCnt,
            'departmentId' => $departmentId,
            'employeeId'   => $employeeId,
            'remark'       => $remark,
            'type'         => 'USE_OUT'
        ));

        if ($client->getRet() == PhalApiClient::RET_OK) {
            Common::unsetNonceStr();
            Common::closeWithMessage('保存成功', 'success', '1200', 0);
        } else {
            Common::resetNonceStr();
            Common::tipWithMessage($client->getMsg(), 'error', '1200');
        }
    } else {
        Common::unsetNonceStr();
        Common::closeWithMessage('表单已失效', 'error', '1200');
    }
}


$rs = $client->request('Order_GetGoods.Go', array(
    'orderId' => $orderId,
    'id'      => $id,
    'type'    => 'USE_OUT'
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}

$departmentId = $method == 'options' ? $departmentId : $goods['departmentId'];


//部门
$rs = $client->request('Department_Options.Go', array());
$department_options = array();
if ($client->getRet() == PhalApiClient::RET_OK) {
    $department_options = $rs['content'];
    unset($department_options[0]);
}
//负责人
$rs = $client->request('Employee_Options.Go', array(
    'companyId'    => $_SESSION[UserSession::SESSION_NAME]['companyId'],
    'departmentId' => $departmentId
));
$employee_options = array();
if ($client->getRet() == PhalApiClient::RET_OK) {
    foreach ($rs['content'] as $row) {
        $employee_options[$row['employeeId']] = $row['employeeName'];
    }

}
$employee_options[0] = "== 请选择 ==";

Template::assign('goods', $goods);
Template::assign('department_options', $department_options);
Template::assign('employee_options', $employee_options);
Template::assign('orderId', $orderId);
Template::assign('departmentId', $departmentId);
Template::assign('id', $id);
Template::display('storage/using_deliver_modify.tpl');
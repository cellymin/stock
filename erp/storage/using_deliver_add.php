<?php
include '../include/init.inc.php';
$id = $orderId = $goodsCnt = $remark = $nonceStr = $departmentId = $employeeId = "";
extract($_REQUEST, EXTR_IF_EXISTS);
$goods = $employee_options = $department_options = array();

$client = new PhalApiClient();

if (Common::isPost()) {
    if ($nonceStr == $_SESSION[UserSession::SESSION_NAME]['form_nonceStr']) {
        $rs = $client->request('Order_InsertGoods.Go', array(
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

//商品
$rs = $client->request('DepotGoods_Get.Go', array(
    'id' => $id
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goods = $rs['content'];
}

//部门
$rs = $client->request('Department_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $department_options = $rs['content'];
}
//负责人
$rs = $client->request('Employee_Options.Go', array(
    'companyId'    => $_SESSION[UserSession::SESSION_NAME]['companyId'],
    'departmentId' => $departmentId
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    foreach ($rs['content'] as $row) {
        $employee_options[$row['employeeId']] = $row['employeeName'];
    }

}
$employee_options[0] = "== 请选择 ==";


Template::assign('_GET', $_GET);
Template::assign('orderId', $orderId);
Template::assign('departmentId', $departmentId);
Template::assign('department_options', $department_options);
Template::assign('employee_options', $employee_options);
Template::assign('goods', $goods);
Template::display('storage/using_deliver_add.tpl');
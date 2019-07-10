<?php
include '../include/init.inc.php';
$orderId = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);
$order     = array();
$page_no   = $page_no ? $page_no : 1;
$page_html = "";

$client = new PhalApiClient();

$rs = $client->request('Order_Get.Go', array(
    'type'      => 'PLAN',
    'orderId'   => $orderId,
    'page_no'   => $page_no,
    'page_size' => 0
));
//echo '<pre/>';var_dump($rs);die();
if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no   = $rs['content']['goods']['page_no'];
    $page_size = $rs['content']['goods']['page_size'];
    $row_count = $rs['content']['goods']['row_count'];

    $order     = $rs['content'];
//    $page_html = Pagination::showPager("plan_order_details.php?orderId=" . $orderId, $page_no, $page_size, $row_count);
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}

$formError = Common::getFormError();
if ($formError) {
    $errMsg  = $formError == 1 ? '操作成功' : $formError;
    $errType = $formError == 1 ? 'success' : 'error';
    Common::tipWithMessage($errMsg, $errType);
}
$nowdate = date('Y-m-d',time());
Template::assign('nowdate', $nowdate);
Template::assign('order', $order);
Template::assign('page_html', $page_html);
Template::assign('url', 'plan_order_add');
Template::assign('modify_url', 'plan_order_modify');
Template::assign('delete_url', 'plan_order_delete');
Template::assign('toReview', 'plan_to_review');
Template::assign('review', 'plan_order_review');
Template::assign('type', 'PLAN');
Template::display('order/details.tpl');
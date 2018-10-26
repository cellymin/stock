<?php
include '../include/init.inc.php';
$orderId = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);
$order     = array();
$page_no   = $page_no ? $page_no : 1;
$page_html = "";

$client = new PhalApiClient();

$rs = $client->request('Order_Get.Go', array(
    'type'      => 'SALE_OUT',
    'orderId'   => $orderId,
    'page_no'   => $page_no,
    'page_size' => 0
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no   = $rs['content']['goods']['page_no'];
    $page_size = $rs['content']['goods']['page_size'];
    $row_count = $rs['content']['goods']['row_count'];

    $order      = $rs['content'];
//    $page_html = Pagination::showPager("allot_deliver_details.php?orderId=".$orderId, $page_no, $page_size, $row_count);
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}

$formError = Common::getFormError();
if ($formError) {
    $errMsg  = $formError == 1 ? '操作成功' : $formError;
    $errType = $formError == 1 ? 'success' : 'error';
    Common::tipWithMessage($errMsg, $errType);
}

$js_confirm = OSAdmin::layerJsConfirm('confirm_before');

Template::assign('order',$order);
Template::assign('page_html', $page_html);
Template::assign('js_confirm', $js_confirm);
Template::assign('url', 'add');
Template::assign('modify_url', 'edit');
Template::assign('delete_url', 'goods_del');
Template::assign('toReview', 'to_review');
Template::assign('review', 'review');
Template::assign('type', 'SALE_OUT');
Template::display('order/details.tpl');
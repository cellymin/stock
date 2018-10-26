<?php
include '../include/init.inc.php';
$orderId = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);
$order     = array();
$page_no   = $page_no ? $page_no : 1;
$page_html = "";

$client = new PhalApiClient();

$rs = $client->request('Order_Get.Go', array(
    'type'      => 'INVENTORY',
    'orderId'   => $orderId,
    'page_no'   => $page_no,
    'page_size' => 0
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no   = $rs['content']['goods']['page_no'];
    $page_size = $rs['content']['goods']['page_size'];
    $row_count = $rs['content']['goods']['row_count'];

    $order      = $rs['content'];
//    $page_html = Pagination::showPager("count_order_details.php?orderId=".$orderId, $page_no, $page_size, $row_count);
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
Template::assign('url', 'count_order_add');
Template::assign('modify_url', 'count_order_modify');
Template::assign('delete_url', 'pd_goods_delete');
Template::assign('toReview', 'pd_to_review');
Template::assign('review', 'count_order_review');
Template::assign('type', 'INVENTORY');
Template::display('order/details.tpl');
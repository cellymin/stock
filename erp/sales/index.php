<?php
include '../include/init.inc.php';
$keyword = $status = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);

$page_no   = $page_no ? $page_no : 1;
$list      = array();
$page_html = "";

$client = new PhalApiClient();

$rs = $client->request('Order_GetList.Go', array(
    'type'      => 'SALE_OUT',
    'page_no'   => $page_no,
    'page_size' => PAGE_SIZE,
    'keyword'   => $keyword,
    'status'    => $status
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $page_no   = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];
    $status    = $rs['content']['status'];

    $list      = $rs['content']['list'];
    $page_html = Pagination::showPager("index.php?keyword=$keyword&status=$status", $page_no, $page_size,
        $row_count);
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}
Template::assign('_GET', $_GET);
Template::assign('type', 'SALE_OUT');
Template::assign('list', $list);
Template::assign('create_url', 'create');
Template::assign('details_url', 'details');
Template::assign('delete_url', 'del');
Template::assign('page_html', $page_html);
Template::display('order/list.tpl');
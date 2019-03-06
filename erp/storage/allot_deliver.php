<?php
include '../include/init.inc.php';
$keyword = $status = $page_no = "";
extract($_GET, EXTR_IF_EXISTS);

$page_no   = $page_no ? $page_no : 1;
$list      = array();
$page_html = "";

$client = new PhalApiClient();

$rs = $client->request('Order_GetList.Go', array(
    'type'      => 'ALLOT_OUT',
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
    $page_html = Pagination::showPager("allot_deliver.php?keyword=$keyword&status=$status", $page_no, $page_size,
        $row_count);
} else {
    Common::tipWithMessage($client->getMsg(), 'error');
}
$company = $client->request('Company_Get.Go', array(
    'companyId'=>$companyId
));
$companyName = $company['content']['companyName'];
$nowdate = strval(date('Y-m-d',time()));
Template::assign('nowdate',$nowdate);
Template::assign('companyName',$companyName);
Template::assign('userName',$userName);
Template::assign('_GET', $_GET);
Template::assign('type', 'ALLOT_OUT');
Template::assign('list', $list);
Template::assign('create_url', 'allot_deliver_create');
Template::assign('details_url', 'allot_deliver_details');
Template::assign('delete_url', 'od_delete');
Template::assign('page_html', $page_html);
Template::display('order/list.tpl');
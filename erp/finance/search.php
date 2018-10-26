<?php
include '../include/init.inc.php';
$page_no = $type = $startTime = $endTime = "";
extract($_GET, EXTR_IF_EXISTS);
$list = array();
$page_html = '';
$client = new PhalApiClient();

$rs = $client->request('Finance_GetList.Go', array(
    'page_no'   => $page_no < 1 ? 1 : $page_no,
    'page_size' => PAGE_SIZE,
    'type'=>$type,
    'startTime'=>$startTime,
    'endTime'=>$endTime,
));
if($client->getRet()==PhalApiClient::RET_OK){
    $page_no   = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];
    $status    = $rs['content']['status'];

    $list      = $rs['content']['list'];
    $page_html = Pagination::showPager("search.php?type=$type&startTime=$startTime&endTime=$endTime", $page_no, $page_size,
        $row_count);
}
Template::assign('list',$list);
Template::assign('_GET',$_GET);
Template::assign('page_html',$page_html);
Template::display('finance/search.tpl');
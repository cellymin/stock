<?php
include '../include/init.inc.php';

$page_no =$page_size = $keyword ="";
extract($_GET,EXTR_IF_EXISTS);
 $page_html ="";
 $list  =array();
 
$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;

$client = new PhalApiClient();

$res = $client->request('Department_GetList.Go',array(
	'page_no'=>$page_no,'page_size'=>$page_size,'keyword'=>$keyword
));
if ($client->getRet() == PhalApiClient::RET_OK) {
	//操作成功处理
	$page_no = $res['content']['page_no'];
	$page_size = $res['content']['page_size'];
	$row_count = $res['content']['row_count'];
	$list = $res['content']['list'];
	
   $page_html=Pagination::showPager("department.php?keyword=$keyword",$page_no,$page_size,$row_count); 
}
Template::assign ( 'list', $list );
Template::assign ( 'page_html', $page_html );
Template::assign ( '_GET', $_GET );
Template::display('sys/department.tpl');
<?php
include '../include/init.inc.php';
$keyword = $depotId = $table = $startTime = $endTime = "";
extract($_REQUEST,EXTR_IF_EXISTS);

if(Common::isPost()){
	//查询返回数据
	$page_size = 1;
	$page_no=$page_no<1?1:$page_no;
	
	$row_count = Chart::chart3Count($keyword, $depotId, $table, $startTime, $endTime);
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$start = ($page_no - 1) * $page_size;
	
	$data = Chart::chart3($start, $page_size, $keyword, $depotId, $table, $startTime, $endTime);
	$data[0]['count'] = $row_count;
	echo json_encode($data);
	exit;
}


//仓库列表
$client = new PhalApiClient();
$depots_options = array();
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
}

Template::assign('depots_options', $depots_options);
Template::display('charts/chart3.tpl');
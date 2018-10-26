<?php
include '../include/init.inc.php';
$keyword = $companyId = $startTime = $endTime = $page_no = "";
extract($_REQUEST, EXTR_IF_EXISTS);

if(Common::isPost()){
	//查询返回数据
	$page_size = 1;
	$page_no=$page_no<1?1:$page_no;
	
	$row_count = Chart::chart1Count($keyword, $companyId, $startTime, $endTime);
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$start = ($page_no - 1) * $page_size;
	
	$data = Chart::chart1($start, $page_size, $keyword, $companyId, $startTime, $endTime);
	$data[0]['count'] = $row_count;
	echo json_encode($data);
	exit;
}

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

if($user_group!=1 && $selectAll!=1){
    $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
}
$client = new PhalApiClient();
$rs = $client->request('Company_Options.Go',array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    if($user_group!=1 && $selectAll!=1){
        unset($company_options[0]);
    }
}

Template::assign('_GET', $_GET);
Template::assign('company_options', $company_options);
Template::display('charts/chart1.tpl');
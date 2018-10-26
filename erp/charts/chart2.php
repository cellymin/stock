<?php
include '../include/init.inc.php';
$companyId = $keyword = $depotId = $depotSubId = "";
extract($_REQUEST,EXTR_IF_EXISTS);

if(empty($depotId)) $depotId=0;

if(Common::isPost()){
	//查询返回数据
	$page_size = 1;
	$page_no=$page_no<1?1:$page_no;
	
	$row_count = Chart::chart2Count($keyword, $depotId, $depotSubId, $companyId);
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$start = ($page_no - 1) * $page_size;
	
	$data = Chart::chart2($start, $page_size, $keyword, $depotId, $depotSubId, $companyId);
	$data[0]['count'] = $row_count;
	echo json_encode($data);
	exit;
}


$client = new PhalApiClient();
$company_options = $depots_options = $depotsSub_options = array();

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

if($user_group!=1 && $selectAll!=1){
    $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
}

//公司列表
$rs = $client->request('Company_Options.Go',array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    if($user_group!=1 && $selectAll!=1){
        unset($company_options[0]);
    }
}

//仓库列表
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
    $depots_options[0] = "== 请选择 ==";
}

//查询库位列表
if(Common::isGet()){
	if(!empty($depotId)){
		$rs = $client->request('DepotSub_Options.Go', array('depotId'=>10));
		if ($client->getRet() == PhalApiClient::RET_OK) {
		    $depotsSub_options = $rs['content'];
		    $depotsSub_options[0] = "== 请选择 ==";
		}
	}
}


Template::assign('_GET', $_GET);
Template::assign('depotId', $depotId);
Template::assign('company_options', $company_options);
Template::assign('depots_options', $depots_options);
Template::assign('depotsSub_options', $depotsSub_options);
Template::display('charts/chart2.tpl');
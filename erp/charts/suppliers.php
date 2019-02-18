<?php
include '../include/init.inc.php';
$cateId = $companyId = $depotId = "";
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

$cates = $company_options = array();
$client = new PhalApiClient();
$rs = $client->request('GoodsCate_GetList.go');
if ($client->getRet() == PhalApiClient::RET_OK) {
    $cates = $rs['content'];
}
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
ksort($depots_options);
$list = Report::busReport($cateId,$companyId,$depotId);

Template::assign('company_options',$company_options);
Template::assign('cates',$cates);
Template::assign('list',$list);
Template::assign('_GET',$_GET);
Template::assign('depots_options', $depots_options);
Template::display('charts/suppliers.tpl');
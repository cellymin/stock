<?php
include '../include/init.inc.php';
$cateId = $companyId = $depotId = $year = $month ="";
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
$companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
$userName= $_SESSION[UserSession::SESSION_NAME]['user_name'];
$cates = $company_options = array();
$client = new PhalApiClient();
$rs =  $client->request('GoodsCate_GetList.go');
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
$company = $client->request('Company_Get.Go', array(
    'companyId'=>$companyId
));
$companyName = $company['content']['companyName'];

//仓库列表
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
    $depots_options[0] = "== 请选择 ==";
}
ksort($depots_options);
if(!$year){
    $year = date('Y',time());
}
if(!$month){
    $month = date('m',time());
}
$list = Report::busReport($cateId,$companyId,$depotId,$year.$month);
//echo '<pre/>';var_dump($list);
//die();
$y = date('Y',time());
$m = date('m',time());
Template::assign('y',$y);
Template::assign('m',$m);
$yarr = array();
for($i=10;$i>=0;$i--){
    $yarr[] = $y-$i ;
    if($y-$i<=0){
        breake;
    }
}
$nowdate = strval(date('Y-m-d',time()));
Template::assign('nowdate',$nowdate);
Template::assign('yarr',$yarr);
Template::assign('company_options',$company_options);
Template::assign('cates',$cates);
Template::assign('list',$list);
Template::assign('_GET',$_GET);
Template::assign('depots_options', $depots_options);
Template::assign('companyName',$companyName);
Template::assign('userName',$userName);
Template::display('charts/suppliers.tpl');
<?php
include '../include/init.inc.php';
$companyId = $startTime = $endTime =$departmentId= "" ;
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

if($user_group!=1 && $selectAll!=1){
    $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
}

$result = Report::usingReport($companyId,$startTime,$endTime,$departmentId);
//echo '<pre/>';
//var_dump($result);die();
$departments = $company_options = array();
$total = 0;
if($result){
    $departments = $result['departments'];
    $total = $result['total'];
    $subinfo = $result['deps'];
    unset($result['deps']);
    unset($result['departments']);
    unset($result['total']);
}

$client = new PhalApiClient();
$rs = $client->request('Company_Options.Go',array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    if($user_group!=1 && $selectAll!=1){
        unset($company_options[0]);
    }
}
$subinfo[0]='全部';
ksort($subinfo);
Template::assign('subinfo',$subinfo);
Template::assign('company_options',$company_options);
Template::assign('departments',$departments);
Template::assign('total',$total);
Template::assign('list',$result);
Template::assign('_GET',$_GET);
Template::display('charts/purchase.tpl');
<?php
include '../include/init.inc.php';
$companyId = $startTime = $endTime = "";
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

if($user_group!=1 && $selectAll!=1){
    $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
}

$result = Report::usingReport($companyId,$startTime,$endTime);

$departments = $company_options = array();
$total = 0;
if($result){
    $departments = $result['departments'];
    $total = $result['total'];
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


Template::assign('company_options',$company_options);
Template::assign('departments',$departments);
Template::assign('total',$total);
Template::assign('list',$result);
Template::assign('_GET',$_GET);
Template::display('charts/purchase.tpl');
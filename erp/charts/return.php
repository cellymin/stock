<?php
include '../include/init.inc.php';
$companyId = $startTime = $endTime = "";
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
$companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
$userName= $_SESSION[UserSession::SESSION_NAME]['user_name'];

$company_options = array();


$client = new PhalApiClient();
$rs = $client->request('Company_Options.Go',array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    if($user_group!=1 && $selectAll!=1){
        unset($company_options[0]);
    }
}

$list = Report::usingReportTotal($companyId ,$startTime ,$endTime);

$company = $client->request('Company_Get.Go', array(
    'companyId'=>$companyId
));
$companyName = $company['content']['companyName'];
$nowdate = strval(date('Y-m-d',time()));
Template::assign('nowdate',$nowdate);
Template::assign('companyName',$companyName);
Template::assign('userName',$userName);
Template::assign('company_options',$company_options);
Template::assign('_GET',$_GET);
Template::assign('list',$list);
Template::display('charts/return.tpl');
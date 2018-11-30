<?php
include '../include/init.inc.php';
$companyId = $startTime = $endTime =$departmentId= $keyword = "" ;
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

if($user_group!=1 && $selectAll!=1){
    $companyId = $_SESSION[UserSession::SESSION_NAME]['companyId'];
}
$page_no   = $_GET['page_no']?$_GET['page_no']:1;
$result = Report::usingReport($companyId,$keyword,$startTime,$endTime,$departmentId,$page_no);
$departments = $company_options = array();
$total = 0;
if($result){
    $goods = $result['goods'];
    $total = $result['total'];
    $subinfo = $result['deps'];//部门

    $page_size = $result['page_size'];
    $row_count = $result['row_count'];
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
if($row_count>0){
    $page_html = Pagination::showPager("purchase.php?purchase.php?companyId=$companyId&departmentId=$departmentId&startTime=$startTime&endTime=$endTime", $page_no, $page_size,
        $row_count);
    Template::assign('page_html', $page_html);
}
Template::assign('subinfo',$subinfo);
Template::assign('company_options',$company_options);
Template::assign('goods',$goods);
Template::assign('total',$total);
Template::assign('_GET',$_GET);
Template::display('charts/purchase.tpl');
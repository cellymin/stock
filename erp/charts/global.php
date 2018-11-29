<?php
include '../include/init.inc.php';
$companyId = $cateId =$keyword= "";
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];
//产品分类
$cates = $company_options = array();
$client = new PhalApiClient();
$rs = $client->request('GoodsCate_Options.Go', array('parentId' => 0));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $cates = $rs['content'];
}

//分公司列表
$company_options = array();
$client = new PhalApiClient();
$rs = $client->request('Company_Options.Go',array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $company_options = $rs['content'];
    if($user_group!=1 && $selectAll!=1){
        unset($company_options[0]);
    }
}
//
//$list = Report::busTotalReport($companyId);
$page_no   =  $_GET['page_no']?$_GET['page_no']:1;
$rs = Chart::report1($companyId, $cateId,$keyword,$page_no);
$list = $rs['list'];
$page_size = $rs['page_size'];
$row_count = $rs['row_count'];
$status    = $rs['status'];
//var_dump($rs['page_no']);
//var_dump($rs['page_size']);
//die();
$page_html = Pagination::showPager("global.php?keyword=$keyword&status=$status", $page_no, $page_size,
    $row_count);

Template::assign('page_html', $page_html);
Template::assign('company_options',$company_options);
Template::assign('list',$list);
Template::assign('cates',$cates);
Template::assign('_GET',$_GET);
Template::display('charts/global.tpl');
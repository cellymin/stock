<?php
include '../include/init.inc.php';
$companyId = $cateId = "";
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


$list = Chart::report1($companyId, $cateId);


Template::assign('company_options',$company_options);
Template::assign('list',$list);
Template::assign('cates',$cates);
Template::assign('_GET',$_GET);
Template::display('charts/global.tpl');
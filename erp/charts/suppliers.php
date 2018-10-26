<?php
include '../include/init.inc.php';
$cateId = $companyId = "";
extract($_GET,EXTR_IF_EXISTS);

$user_group = $_SESSION[UserSession::SESSION_NAME]['user_group'];
$selectAll = $_SESSION[UserSession::SESSION_NAME]['selectAll'];

$cates = $company_options = array();
$client = new PhalApiClient();
$rs = $client->request('GoodsCate_Options.Go', array('parentId' => 0));
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

$list = Report::busReport($cateId,$companyId);

Template::assign('company_options',$company_options);
Template::assign('cates',$cates);
Template::assign('list',$list);
Template::assign('_GET',$_GET);
Template::display('charts/suppliers.tpl');
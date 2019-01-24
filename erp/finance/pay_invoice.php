<?php
include '../include/init.inc.php';
$invoiceId = $page_no = $action = "";
extract($_GET, EXTR_IF_EXISTS);

$invoice = $order = array();
$page_html = '';
$client = new PhalApiClient();
//$invoiceId = explode(',',$invoiceId);
//获取供应商名称 id 发票id 订单id
if ($action == 'changeSta') {
    $invoiceids = $_POST['invoiceIds'];
    // echo json_encode($invoiceids);
    $res = $client->request('Invoice_Update.Go', array(
        'invoiceId' => $invoiceids
    ));
    if ($res['code'] == 1) {
        echo $res['code'];
        exit();
    } else {
        echo $res['code'];
        exit();
    }
}
$rs = $client->request('Invoice_Get.Go', array(
    'invoiceId' => $invoiceId,
    'action' => 3
));
if ($rs['lionid'][1]) {
    $lionid = $rs['lionid'][1];
    if (strlen($lionid) > 0) {
        $invoiceId = $invoiceId . ',' . $lionid;
    }
    $invoiceId = array_unique(explode(',', $invoiceId));
    asort($invoiceId);
    $invoiceId = implode(',', $invoiceId);
    if (!empty($rs['lionid'][2])) {
        $adjustpri = $rs['lionid'][2];
        if($adjustpri>=0){
            $adjustpri = '+'.$adjustpri;
        }
        Template::assign('adjustpri', $adjustpri);
    }
}else if($rs['lionid']['inids']){ //所有关联发票id
    asort($rs['lionid']['inids']);
    $invoiceId = implode(',', $rs['lionid']['inids']);
    if($rs['lionid']['adjprilist']){
        $adjustpri = floatval($rs['lionid']['adjprilist']) + $rs['lionid']['departprinum'];
        if($adjustpri>=0){
            $adjustpri = '+'.$adjustpri;
        }
        Template::assign('adjustpri', $adjustpri);
    }
}else if(is_numeric($rs['lionid']['departprinum'])){
    $adjustpri = $rs['lionid']['departprinum'];
    if($adjustpri>=0){
        $adjustpri = '+'.$adjustpri;
    }
    Template::assign('adjustpri', $adjustpri);
}
if ($client->getRet() == PhalApiClient::RET_OK) {
    $invoiceInfo = $rs['content'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}
//var_dump($invoiceId);die();
$rsd = $client->request('Invoice_GetInfo.Go', array(
    'invoiceId' => $invoiceId,
    'lionIds' => $rs['lionid'][1],
    'lionNo' => $rs['lionNo'][0]
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $goodsList = $rsd['content'];
    $orderNo = $rsd['order'];
    $ifhe = $rsd['ifhe'];
    $invoiceInfo = $rs['content'];
    $spanno = $rsd['kk'];
} else {
    Common::closeWithMessage($client->getMsg(), 'error');
}


$date = date('Y/m/d', time());
$supno = count($orderNo) + intval($rsd['count']);
unset($rs);
unset($rsd);

Template::assign('invoiceId', $invoiceId);
Template::assign('date', $date);
Template::assign('supno', $supno);
Template::assign('spanno', $spanno);
Template::assign('invoiceInfo', $invoiceInfo);
Template::assign('orderNo', $orderNo);
Template::assign('_GET', $_GET);
Template::assign('goodsList', $goodsList);
Template::assign('supplierId', $supplierId ? $supplierId : 0);
Template::display('finance/pay_invoice.tpl');
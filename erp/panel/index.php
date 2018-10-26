<?php
require('../include/init.inc.php');
$priceWarningMsg = $waitWarningMsg = $depotWarningMsg = array();
//获取发票预警消息
if (!isset($_SESSION[UserSession::SESSION_NAME]['isWarnMsg']) || empty($_SESSION[UserSession::SESSION_NAME]['isWarnMsg'])) {
    $client = new PhalApiClient();
    $client->request('Warning_Message.Go', array());
    $_SESSION[UserSession::SESSION_NAME]['isWarnMsg'] = 1;
}


//价格预警消息
$priceWarningMsg = Message::warningMsg(0, 6, 2);
if ($priceWarningMsg) {
    foreach ($priceWarningMsg as &$item) {
        $temp = json_decode($item['content']);
        $item['content'] = array();
        $item['content']['goodsName'] = $temp->goodsName;
        $item['content']['type'] = $temp->type;
        $item['content']['value'] = $temp->value;
    }
}

//待办事宜
$waitWarning = Message::warningMsg(0, 0, 3);
$invoiceCount = 0;
$moneyCount = 0;
if ($waitWarning) {
    foreach ($waitWarning as $v) {
        if ($v['showType'] == 0) {
            $waitWarningMsg[] = $v;
            continue;
        }
        if ($v['showType'] == 4) {
            $invoiceCount += 1;
            continue;
        }
        if ($v['showType'] == 5) {
            $moneyCount += 1;
            continue;
        }
    }
}

$depotWarning = Message::warningMsg(0, 0, 1);
$count1 = $count2 = $count3 = 0;
if ($depotWarning) {
    foreach ($depotWarning as $v) {
        if ($v['showType'] == 1) {
            $count1 += 1;
            continue;
        }
        if ($v['showType'] == 2) {
            $count2 += 1;
            continue;
        }
        if ($v['showType'] == 3) {
            $count3 += 1;
            continue;
        }
    }
}

$data = Goods::indexChart();
$chart = array('data1' => array(), 'data2' => array(),'data3'=>array());
if ($data) {
    foreach ($data as $v){
        $chart['data1'][] = $v['money'];
        $chart['data2'][] = $v['cnt'];
        $chart['data3'][] = date('Y-').$v['mth'];
    }
}


$waitWarningMsg = $waitWarningMsg ? array_slice($waitWarningMsg, 0, 3) : array();

$user_info = UserSession::getSessionInfo();
$menus = MenuUrl::getMenuByIds($user_info['shortcuts']);
Template::assign('menus', $menus);
Template::assign('priceWarningMsg', $priceWarningMsg);
Template::assign('waitWarningMsg', $waitWarningMsg);
Template::assign('invoiceCount', $invoiceCount);
Template::assign('moneyCount', $moneyCount);
Template::assign('count1', $count1);
Template::assign('count2', $count2);
Template::assign('count3', $count3);
Template::assign('chart', json_encode($chart));
Template::display('index.tpl');
<?php
include '../include/init.inc.php';
$keyword = $goodsCateId = $page_no = $type = $depotId = $depotSubId = $orderId = "";
extract($_GET, EXTR_IF_EXISTS);
$list = $goodsCate = $order = $depotSubs = array();
$page_no = $page_no ? $page_no : 1;
$page_html = "";

$client = new PhalApiClient();

if (in_array($type, array('ALLOT_OUT', 'USE_OUT', 'INVENTORY'))) {

    //订单
    $rs = $client->request('Order_Get.Go', array(
        'type'      => $type,
        'orderId'   => $orderId,
        'page_no'   => 1,
        'page_size' => 1
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $order = $rs['content'];
    }


    $rs = $client->request('DepotGoods_GetList.Go', array(
        'keyword'    => $keyword,
        'depotId'    => $order['depotId'],
        'depotSubId' => $depotSubId,
        'page_no'    => $page_no,
        'page_size'  => 7,
    ));

    if ($client->getRet() == PhalApiClient::RET_OK) {
        $page_no = $rs['content']['page_no'];
        $page_size = $rs['content']['page_size'];
        $row_count = $rs['content']['row_count'];
        $status = $rs['content']['status'];

        $list = $rs['content']['list'];
        $page_html = Pagination::showPager("goods_search.php?keyword=$keyword&depotId=$depotId&depotSubId=$depotSubId&type=$type",
            $page_no,
            $page_size,
            $row_count);
    } else {
        Common::tipWithMessage($client->getMsg(), 'error');
    }


    $rs = $client->request('DepotSub_Options.Go', array(
        'depotId' => $order['depotId']
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $depotSubs = $rs['content'];
    }
    $depotSubs[0] = '== 请选择库位 ==';
    Template::assign('depotSubs', $depotSubs);

} else {

    $rs = $client->request('Goods_GetListForOrder.Go', array(
        'type'        => 'PLAN',
        'keyword'     => $keyword,
        'goodsCateId' => $goodsCateId,
        'page_no'     => $page_no,
        'page_size'   => 7,
    ));

    if ($client->getRet() == PhalApiClient::RET_OK) {
        $page_no = $rs['content']['page_no'];
        $page_size = $rs['content']['page_size'];
        $row_count = $rs['content']['row_count'];
        $status = $rs['content']['status'];

        $list = $rs['content']['list'];
        $page_html = Pagination::showPager("goods_search.php?keyword=$keyword&goodsCateId=$goodsCateId&type=$type",
            $page_no,
            $page_size,
            $row_count);
    } else {
        Common::tipWithMessage($client->getMsg(), 'error');
    }

    $rs = $client->request('GoodsCate_GetList.Go', array());
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $goodsCate = $rs['content'];
    } else {
        Common::tipWithMessage($client->getMsg(), 'error');
    }

    Template::assign('goodsCate', $goodsCate);

}


$orderAddUrl = Common::getOrderAddUrl($type);
if (!$orderAddUrl) {
    Common::closeWithMessage('路径错误', 'error');
}


Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('orderAddUrl', $orderAddUrl);
Template::assign('page_html', $page_html);
Template::assign('depotSubId', $depotSubId ? $depotSubId : 0);
Template::assign('page_html', $page_html);
Template::display('storage/goods_search.tpl');
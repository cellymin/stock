<?php
include '../include/init.inc.php';
$depotId = $depotSubId = $page_no = $keyword = "";
extract($_GET, EXTR_IF_EXISTS);

$list = array();
$page_html = '';
$client = new PhalApiClient();

$rs = $client->request('DepotGoods_GetList.Go', array(
    'page_no'    => $page_no ? $page_no : 1,
    'page_size'  => 10,
    'depotId'    => $depotId,
    'depotSubId' => $depotSubId,
    'keyword'    => $keyword
));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $list = $rs['content']['list'];

    $page_no = $rs['content']['page_no'];
    $page_size = $rs['content']['page_size'];
    $row_count = $rs['content']['row_count'];

    $page_html = Pagination::showPager("depotSub_goods.php?keyword=$keyword&depotId=$depotId&depotSubId=$depotSubId",
        $page_no, $page_size, $row_count);
}

$depotSub = array();

$rs = $client->request('DepotSub_Get.Go', array('depotSubId' => $depotSubId));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depotSub = $rs['content'];
}

$formError = Common::getFormError();
if ($formError) {
    if ($formError == 1) {
        Common::closeWithMessage('操作成功', 'success');
    } else {
        Common::tipWithMessage($formError, 'error');
    }
}

Template::assign('_GET', $_GET);
Template::assign('list', $list);
Template::assign('depotSub', $depotSub);
Template::assign('page_html', $page_html);
Template::display('sys/depotSub_goods.tpl');
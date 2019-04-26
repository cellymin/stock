<?php
include '../include/init.inc.php';
include '../include/lib/PinYin.class.php';
$page_no = $page_size = $suppId = $depotSubId = $depotId = $goodsId = $goodsName = $action = $goodslist = $toalNum = $totalPri = $taxrate = "";
$page_size = PAGE_SIZE;
$page_no = $page_no < 1 ? 1 : $page_no;
extract($_POST, EXTR_IF_EXISTS);
$client = new PhalApiClient();
$page_no = $page_no ? $page_no : 1;
if (Common::isPost()) {
    if ($action == 'add') {
        $suppId = intval($suppId);
        $depotId = intval($depotId);
        $depotSubId = intval($depotSubId);
        $toalNum = floatval($toalNum);
        $totalPri = floatval($totalPri);
        $taxrate = floatval($taxrate);

        if (!$suppId > 0) {
            $rs['code'] = 0;
            $rs['msg'] = '没有供应商';
            echo json_encode($rs);
            exit();
        }
        if (!$depotId > 0) {
            $rs['code'] = 0;
            $rs['msg'] = '没有选择仓库';
            echo json_encode($rs);
            exit();
        }
        if (!$depotSubId > 0) {
            $rs['code'] = 0;
            $rs['msg'] = '没有选择库位';
            echo json_encode($rs);
            exit();
        }
        if (!$toalNum > 0) {
            $rs['code'] = 0;
            $rs['msg'] = '数量不能为空';
            echo json_encode($rs);
            exit();
        }
        if (!$taxrate > 0 || $taxrate > 1) {
            $rs['code'] = 0;
            $rs['msg'] = '税率非法';
            echo json_encode($rs);
            exit();
        }
        $ll = array();
        $goosL = array();
        $goodslist = json_decode($goodslist);

        foreach ($goodslist as $k => $v) {
            $ll[$k] = explode(',', $v);
        }
        foreach ($ll as $k => $v) {
            foreach ($v as $kk => $vv) {
                $tt = explode('--', $vv);
                $goosL[$k][$tt[0]] = $tt[1];
            }
        }

        $rs = $client->request('Depot_InputDe.Go', array(
            'goosL' => json_encode($goosL),
            'suppId' => $suppId,
            'depotId' => $depotId,
            'depotSubId' => $depotSubId,
            'toalNum' => $toalNum,
            'totalPri' => $totalPri,
            'taxrate' => $taxrate
        ));
        echo json_encode($rs);
        exit();
    } else {
        if ($depotId > 1) {
            $rs = $client->request('DepotSub_Options.Go', array(
                'depotId' => $depotId
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                $depotSubs_options = $rs['content'];
            }
            echo json_encode($depotSubs_options);
        }
        if ($goodsId > 1) {
            $rs = $client->request('Goods_UpdateName.Go', array(
                'goodsId' => intval($goodsId),
                'goodsName' => $goodsName
            ));
            echo json_encode($rs);
        }
    }
    exit();

}
$rs = $client->request('Goods_GetList.Go', array(
    'page_no' => $page_no,
    'page_size' => 999,
    'keyword' => $keyword,
    'goodsCateId' => 0
));
//echo '<pre/>';var_dump($rs);die();
if ($client->getRet() == PhalApiClient::RET_OK) {
    $pinyin = new PinYin();
    $goods_options = $rs['content']['list'];
    $new_goods_options = array();
    if (!empty($goods_options)) {
        foreach ($goods_options as $k => $v) {
            $new_goods_options[$v['goodsId']]['goodsId'] = $v['goodsId'];
            $new_goods_options[$v['goodsId']]['goodsName'] = $v['goodsName'];
            $new_goods_options[$v['goodsId']]['pinyin'] = $pinyin->getpy($v['goodsName']);
            $new_goods_options[$v['goodsId']]['jianxie'] = $pinyin->getpy($v['goodsName'], false);
            $new_goods_options[$v['goodsId']]['goodsSpec'] = $v['goodsSpec'];//规格
            $new_goods_options[$v['goodsId']]['unitName'] = $v['unitName'];//单位
            if ($v['usecostpri'] > 0) {
                $new_goods_options[$v['goodsId']]['lastPrice'] = $v['usecostpri'];
            } else {
                $new_goods_options[$v['goodsId']]['lastPrice'] = $v['lastPrice'];
            }
            $new_goods_options[$v['goodsId']]['depotId'] = $v['depotId'];//仓库id
            $new_goods_options[$v['goodsId']]['depotSubId'] = $v['depotSubId'];//库位id
        }
    }
}
//echo '<pre/>';
//var_dump($new_goods_options);die();

$rs = $client->request('Supplier_Options.Go', array('type' => 1));
if ($client->getRet() == PhalApiClient::RET_OK) {
    $pinyin = new PinYin();
    $suppliers_options = $rs['content'];
    $suppliers_options[0] = "== 请选择 ==";
    $new_suppliers_options = array();
    foreach ($suppliers_options as $k => $v) {
        $new_suppliers_options[$k]['id'] = $k;
        $new_suppliers_options[$k]['name'] = $v['supplierName'];
        $new_suppliers_options[$k]['taxrate'] = $v['taxrate'];
        $new_suppliers_options[$k]['pinyin'] = $pinyin->getpy($v['supplierName']);
        $new_suppliers_options[$k]['jianxie'] = $pinyin->getpy($v['supplierName'], false);
    }
//    echo '<pre/>';var_dump($new_suppliers_options);die();
}
$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
    $depots_options[0] = '==请选择==';
}
ksort($depots_options);
Template::assign('depots_options', $depots_options);
Template::assign('suppliers_options', $new_suppliers_options);
Template::assign('form_url', 'purchase_storage_create.php');
Template::assign('suppliers_url', 'suppliers_choose');
Template::assign('goods_url', 'goods_choose');
Template::assign('type', '1');
Template::assign('isgai', '1');
Template::assign('goods_options', $new_goods_options);
Template::display('storage/purchase_storage_create.tpl');





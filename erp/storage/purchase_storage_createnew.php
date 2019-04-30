<?php
include '../include/init.inc.php';
include '../include/lib/PinYin.class.php';
$page_no = $reviewer = $page_size = $suppId = $depotSubId = $depotId = $goodsId = $goodsName = $action = $goodslist = $toalNum = $totalPri = $taxrate = $orderId = $oldGoosNamesstr = $tab = $beizhu = "";
$page_size = PAGE_SIZE;
$page_no = $page_no < 1 ? 1 : $page_no;
extract($_GET, EXTR_IF_EXISTS);
extract($_POST, EXTR_IF_EXISTS);
$client = new PhalApiClient();
$page_no = $page_no ? $page_no : 1;
//
//$pinyin = new PinYin();
//$input_data['quanpin'] = strtoupper($pinyin->getpy('你好'));
//$input_data['jianxie'] = strtoupper($pinyin->getpy('你好', false));
//var_dump($input_data);die();
if (intval($orderId) > 0) {
    $rs = $client->request('Order_Get.Go', array(
        'type' => 'PURCHASE_IN',
        'orderId' => $orderId,
        'page_no' => $page_no,
        'page_size' => 0
    ));
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $page_no = $rs['content']['goods']['page_no'];
        $page_size = $rs['content']['goods']['page_size'];
        $row_count = $rs['content']['goods']['row_count'];

        $order = $rs['content'];
//        echo '<pre/>';var_dump($order);die();
    } else {
        Common::tipWithMessage($client->getMsg(), 'error');
    }
//    echo '<pre/>';var_dump($order);die();
    Template::assign('order', $order);
}
if ($tab == 1) {
    if (Common::isPost()) {
        if ($action == 'add') {
//        var_dump($_POST);die();
            $suppId = intval($suppId);
            $depotId = intval($depotId);
            $depotSubId = intval($depotSubId);
            $toalNum = floatval($toalNum);
            $totalPri = floatval($totalPri);
            $taxrate = floatval($taxrate);
            $beizhu = trim($beizhu);
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
                'taxrate' => $taxrate,
                'beizhu' => $beizhu
            ));
            echo json_encode($rs);
            exit();
        } else if ($action == 'edit' && intval($orderId > 0)) {
            $suppId = intval($suppId);
            $depotId = intval($depotId);
            $depotSubId = intval($depotSubId);
            $toalNum = floatval($toalNum);
            $totalPri = floatval($totalPri);
            $taxrate = floatval($taxrate);
            $orderId = intval($orderId);
            $beizhu = trim($beizhu);
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
//        var_dump($oldGoosNamesstr);die();
            $rs = $client->request('Depot_UpdateDe.Go', array(
                'orderId' => $orderId,
                'oldGoosNamesstr' => $oldGoosNamesstr,
                'goosL' => json_encode($goosL),
                'suppId' => $suppId,
                'depotId' => $depotId,
                'depotSubId' => $depotSubId,
                'toalNum' => $toalNum,
                'totalPri' => $totalPri,
                'taxrate' => $taxrate,
                'beizhu' => $beizhu
            ));
            echo json_encode($rs);
            exit();
        } else if ($action == 'pass' && intval($orderId > 0)) {
            $rs = $client->request('Order_Save.Go', array(
                'type' => 'PURCHASE_IN',
                'orderId' => intval($orderId),
                'reviewer' => intval($_SESSION['vich_user_info']['user_id'])
            ));
            if ($client->getRet() == PhalApiClient::RET_OK) {
                echo json_encode($rs);
                exit();
            } else {
                $rs['msg'] = $client->getMsg();
                echo json_encode($rs);
                exit();
            }
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
                $redis->set("new_goods_options", '');
                echo json_encode($rs);
            }
        }
        exit();
    }
}
if ($tab == 1) {
    if (empty($new_goods_options)) {
        $rs = $client->request('Goods_GetList.Go', array(
            'page_no' => $page_no,
            'page_size' => 999,
            'keyword' => $keyword,
            'goodsCateId' => 0
        ));
//echo '<pre/>';var_dump($rs);die();
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $goods_options = $rs['content']['list'];
            $new_goods_options = array();
                foreach ($goods_options as $k => $v) {
                    $new_goods_options[$v['goodsId']]['goodsId'] = $v['goodsId'];
                    $new_goods_options[$v['goodsId']]['goodsName'] = $v['goodsName'];
                    $new_goods_options[$v['goodsId']]['pinyin'] = strtolower($v['quanpin']);
                    $new_goods_options[$v['goodsId']]['jianxie'] = strtolower($v['jianxie']);
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

        $rs = $client->request('Supplier_Options.Go', array('type' => 1));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $suppliers_options = $rs['content'];
            $suppliers_options[0] = "== 请选择 ==";
            $new_suppliers_options = array();
            foreach ($suppliers_options as $k => $v) {
                $new_suppliers_options[$k]['id'] = $k;
                $new_suppliers_options[$k]['name'] = $v['supplierName'];
                $new_suppliers_options[$k]['taxrate'] = $v['taxrate'];
                $new_suppliers_options[$k]['pinyin'] = strtolower($v['quanpin']);
                $new_suppliers_options[$k]['jianxie'] = strtolower($v['jianxie']);
            }
        }
}

$rs = $client->request('Depot_Options.Go', array());
if ($client->getRet() == PhalApiClient::RET_OK) {
    $depots_options = $rs['content'];
    $depots_options[0] = '==请选择==';

    ksort($depots_options);
    Template::assign('depots_options', $depots_options);
    Template::assign('suppliers_options', $new_suppliers_options);
    Template::assign('form_url', 'purchase_storage_create.php');
    Template::assign('suppliers_url', 'suppliers_choose');
    Template::assign('goods_url', 'goods_choose');
    Template::assign('type', '1');
    Template::assign('isgai', '1');
    Template::assign('goods_options', $new_goods_options);

}
if ($tab == 1) {
    Template::display('storage/purchase_storage_create.tpl');
} else {
    Template::display('storage/purchase_storage_detail.tpl');
}




<?php
include '../include/init.inc.php';
include '../include/lib/PinYin.class.php';
$page_no = $reviewer = $page_size = $suppId = $depotSubId = $depotId = $goodsId = $goodsName = $action = $goodslist = $toalNum = $totalPri = $taxrate = $orderId = $oldGoosNamesstr = $tab = $beizhu = $departmentId = $goodsCnt = $pn = $depotgoodsId = "";
$page_size = PAGE_SIZE;
$page_no = $page_no < 1 ? 1 : $page_no;
extract($_GET, EXTR_IF_EXISTS);
extract($_POST, EXTR_IF_EXISTS);
$client = new PhalApiClient();
$page_no = $page_no ? $page_no : 1;

if (intval($orderId) > 0) {
    $rs = $client->request('Order_Get.Go', array(
        'type' => 'USE_OUT',
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
        }else if($action=='ifnum' && $goodsCnt>0){
            $goodsId = intval($goodsId);
            $depotgoodsId = intval($depotgoodsId);
            $goodsCnt = floatval($goodsCnt);
            $rs = $client->request('Depot_ChkNum.Go', array(
                'depotgoodsId' => $depotgoodsId,
                'goodsCnt' => $goodsCnt
            ));
//            var_dump($rs);die();
            if ($client->getRet() == PhalApiClient::RET_OK) {
                echo json_encode($rs);
                exit();
            } else {
                $rs['msg'] = $client->getMsg();
                echo json_encode($rs);
                exit();
            }
        } else {
            if($departmentId>0){
                $rs = $client->request('Employee_Options.Go', array(
                    'companyId'    => $_SESSION[UserSession::SESSION_NAME]['companyId'],
                    'departmentId' => $departmentId
                ));
                if ($client->getRet() == PhalApiClient::RET_OK) {
                    foreach ($rs['content'] as $row) {
                        $employee_options[$row['employeeId']] = $row['employeeName'];
                    }
                    echo json_encode($employee_options);
                }
            }

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
        $rs = $client->request('DepotGoods_GetListNo.Go', array(
            'page_no'    => $page_no,
            'type'    => $type,
            'page_size'  => 999,
        ));
        if ($client->getRet() == PhalApiClient::RET_OK) {
            $goods_options = $rs['content']['list'];
            $new_goods_options = array();
                foreach ($goods_options as $k => $v) {
                    $new_goods_options[ $v['id']]['goodsId'] = $v['goodsId'];
                    $new_goods_options[$v['id']]['goodsName'] = $v['goodsName'].'_'.$v['batchNo'];
                    $new_goods_options[$v['id']]['pinyin'] = strtolower($v['quanpin'].'_'.$v['batchNo']);
                    $new_goods_options[$v['id']]['jianxie'] = strtolower($v['jianxie'].'_'.$v['batchNo']);
                    $new_goods_options[$v['id']]['depotId'] = $v['depotId'];//仓库id
                    $new_goods_options[$v['id']]['depotSubId'] = $v['depotSubId'];//库位id
                    $new_goods_options[$v['id']]['supplierId'] = $v['supplierId'];//供应商
                    $new_goods_options[$v['id']]['depotName'] = $v['depotName'];//库位id
                    $new_goods_options[$v['id']]['depotSubName'] = $v['depotSubName'];//库位id
                    $new_goods_options[$v['id']]['goodsPrice'] = $v['goodsPrice'];//成本价
                    $new_goods_options[$v['id']]['createTime'] = $v['createTime'];//
                }
            }
        }
    $rs = $client->request('Department_Options.Go', array());
    if ($client->getRet() == PhalApiClient::RET_OK) {
        $department_options = $rs['content'];
    }

}
//echo '<pre/>';var_dump($new_goods_options);die();
    Template::assign('department_options', $department_options);
    Template::assign('form_url', 'using_deliver_createnew.php');
    Template::assign('goods_url', 'depot_goods_choose');
    Template::assign('type', '1');
    Template::assign('isgai', '1');
    Template::assign('goods_options', $new_goods_options);

if ($tab == 1) {
    Template::display('storage/using_deliver_create.tpl');
} else {
    Template::display('storage/using_deliver_detail.tpl');
}




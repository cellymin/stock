﻿<?php

class Api_Depot_InputDepot extends PhalApi_Api
{
    protected function filterCheck()
    {
    }

    public function getRules()
    {
        return array(
            'getList' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int')
            ),
        );
    }

    public function getList()
    {
        $rs = array('code' => 0, 'data' => '', 'msg' => '');
//        获取供应商列表
        $S_domain = new Domain_Supplier_CURD();
        $suppliers = $S_domain->appGetlist();
        $rs['data']['suppliers'] = $suppliers;
//        获取仓库列表
        $D_domain = new Domain_Depot_CURD();
        $depots = $D_domain->getList();
        $rs['data']['depots'] = $depots;
//        获取库位列表
        if (isset($_POST['depotId'])) {
            $depotId = $_POST['depotId'];
        }
//        当选择仓库时，获取库位信息；否则提示请选择仓库
        if (isset($depotId)) {
            $DS_domain = new Domain_DepotSub_Options();
            $depotSubs = $DS_domain->appGet($depotId);
            $rs['data']['depotSubs'] = $depotSubs;
        }
        $rs['code'] = 1;
        $rs['msg'] = '获取成功';
        return $rs;
    }

    public function getGoodsInfo()
    {
        $rs = array('code' => 0, 'data' => '', 'msg' => '');
        if ($_POST['depotId'] && $_POST['depotSubId'] && $_POST['supplierId']) {
            $goods_domain = new Domain_Goods_CURD();
            $goods = $goods_domain->getGoods($_POST['goodsBarCode']);
            if ($goods) {
                $rs['data']['goodsId'] = $goods['goodsId'];
                $rs['data']['goodsName'] = $goods['goodsName'];
                $rs['data']['lastPrice'] = $goods['lastPrice'];
                $rs['code'] = 1;
                $rs['msg'] = '获取商品信息成功';
            } else {
                $rs['msg'] = '该商品不存在';
                return $rs;
            }
        } else {
            $rs['msg'] = '请选择完整入库信息';
            return $rs;
        }
    }

    public function summitInput()
    {
        $rs = array('code' => 0, 'data' => '', 'msg' => '');
        $totalcnt = 0;
        $totalmoney = 0;
        $operator = $_REQUEST['operator'] ? intval($_REQUEST['operator']) : 0;//操作人
        $depotId = $_REQUEST['depotId'] ? intval($_REQUEST['depotId']) : 0; //仓库
        $depotSubId = $_REQUEST['depotSubId'] ? intval($_REQUEST['depotSubId']) : 0;//库位
        $companyId = $_REQUEST['companyId'] ? intval($_REQUEST['companyId']) : 0;//公司
        $postModel = file_get_contents('php://input');
        $postModel = json_decode($postModel, true);
        if (!empty($postModel['supplier']) && !empty($postModel['goodsList']) && !empty($operator)) {
            $taxrate = $postModel['supplier']['taxrate'] ? floatval($postModel['supplier']['taxrate']) : 0;  //税率
            $supplierId = $postModel['supplier']['supplierId'] ? intval($postModel['supplier']['supplierId']) : 0; //供应商
            // return $supplierId;
            if (empty($supplierId)) {
                $rs['msg'] = '没有供应商';
                return $rs;
            }
            if (empty($depotId)) {
                $rs['msg'] = '没有仓库';
                return $rs;
            }
            if ($taxrate > 1) {
                $rs['msg'] = '税率不能大于1';
                return $rs;
            }
            $model = new Model_Supplier();
            $supplier = $model->getForOrder($supplierId);

            if (!$supplier) {
                $rs['msg'] = '供应商不存在';
                return $rs;
            }
            $model = new Model_Depot();
            $ifdepot = $model->getById($depotId);

            if (!$ifdepot) {
                $rs['msg'] = '仓库不存在';
                return $rs;
            }
            try {
                DI()->notorm->beginTransaction('db_demo');
                $orderInfo = array(
                    'supplierId' => $supplierId,
                    'orderNo' => 'IP' . date('ymdHis') . rand(1000, 9999),
                    'totalMoney' => 0,
                    'totalCnt' => 0,
                    'flag' => 0,
                    'createCompany' => $companyId,
                    'createUser' => intval($operator),
                    'createTime' => date('Y-m-d H:i:s'),
                    'from' => 2
                );
                $goodsmodel = new Model_OrderGoods();
                $log_model = new Model_LogOrder();
                $res = DI()->notorm->orders_ip->insert($orderInfo);
                if ($res['id']) {
                    $orderId = $res['id'];
                    foreach ($postModel['goodsList'] as $k => $v) {
                        if (empty($v['goodsId'])) {
                            $rs['msg'] = '没有商品ID';
                            return $rs;
                        }
                        $v['remark'] = $v['remark'] ? intval($v['remark']) : 2;
                        if (intval($v['remark']) == 1) { //含税价作为成本
                            $ratepri = floatval($v['lastPrice']); //含税价
                            $usecostpri = round($ratepri / (1 + $taxrate), 6); //不含税价格
                            $goodsPrice = $ratepri; //成本价
                        } else if (intval($v['remark']) == 2) { //不含税价作为成本
                            $ratepri = floatval($v['lastPrice']); //含税价
                            $usecostpri = round($ratepri / (1 + $taxrate), 6); //不含税价格
                            $goodsPrice = $usecostpri; //成本价
                        }

                        $totalcnt = floatval($v['num']) + $totalcnt;
                        $totalmoney = floatval($v['num']) * $goodsPrice + $totalmoney;
                        $input = array(
                            'supplierId' => $supplierId,
                            'goodsId' => $v['goodsId'],
                            'orderId' => $orderId,
                            'goodsCnt' => $v['num'],
                            'depotId' => $depotId,
                            'depotSubId' => $depotSubId,
                            'goodsPrice' => $goodsPrice,//成本价
                            'ratepri' => $ratepri,//含税价
                            'usecostpri' => $usecostpri,//不含税价
                            'orderSubNo' => 'PN' . date('ymdHis') . rand(1000, 9999),
                            'flag' => 1,
                            'createUser' => intval($operator),
                            'createTime' => date('Y-m-d H:i:s')

                        );
                        DI()->notorm->orders_ip_goods->insert($input);

                        $logId[] = $log_model->insert(array(
                            'logUser' => intval($operator),
                            'logType' => 'INSERT',
                            'logContent' => json_encode($input),
                            'orderId' => $orderId,
                            'orderType' => 'PURCHASE_IN',
                            'createTime' => date('Y-m-d H:i:s')
                        ));
                    }
                }
                $orderUpdate = array(
                    'totalMoney' => $totalmoney,
                    'totalCnt' => $totalcnt,
                    'updateTime' => date('Y-m-d H:i:s'),
                    'updateUser' => $operator['uid']
                );
                $num = DI()->notorm->orders_ip->where('orderId', $orderId)->update($orderUpdate);
                DI()->notorm->commit('db_demo');
                $rs['code'] = 1;
                $rs['msg'] = '提交成功';
                return $rs;

            } catch (PDOException $e) {
                DI()->notorm->rollback('db_demo');
                throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
            }
        } else if (empty($postModel['supplier'])) {
            $rs['msg'] = '供应商信息不完整';
            return $rs;
        } else if (empty($postModel['goodsList'])) {
            $rs['msg'] = '没有要提交的商品';
            return $rs;
        } else if (empty($operator)) {
            $rs['msg'] = '没有操作人';
            return $rs;
        }


    }


}
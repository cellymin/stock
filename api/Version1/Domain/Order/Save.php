<?php

class Domain_Order_Save
{
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function save($orderId, $reviewer,$flag='')
    {
        if($this->type=='PURCHASE_IN' || $this->type=='USE_OUT' || $this->type=='ALLOT_OUT' || $this->type=='ALLOT_IN' || $this->type=='USE_RETURN'|| $this->type=='PURCHASE_RETURN'){
            $flag=3;
        }
        $model = new Model_Order();
        $order = $model->get($orderId);

        if (!$order || !in_array($order['flag'], array(0, -3))) {
            if($order['flag']==3){
                throw new PhalApi_Exception_BadRequest('订单已审核', 0);
            }
            throw new PhalApi_Exception_BadRequest('订单不存在', 0);
        }
        if (DI()->userInfo['userId'] != $order['createUser']) {
            throw new PhalApi_Exception_BadRequest('没有权限', 0);
        }
        if ($order['totalCnt'] == 0) {
            throw new PhalApi_Exception_BadRequest('空订单不能提交！', 0);
        }
        //验证审核人
        $domain = new Domain_Reviewer_Options();
        $role = $domain->getRole($this->type);

        $user_model = new Model_User();
        $user_group = $user_model->getUserGroup($reviewer);
        $user_group_array = explode(',', $user_group[0]['group_role']);

        if (!in_array($role, $user_group_array)) {
            throw new PhalApi_Exception_BadRequest('审核人没有权限！', 0);
        }

        if(empty($flag)){
            $input = array(
                'flag'         => 1,
                'reviewer'     => $reviewer,
                'reviewerMemo' => '',
                'updateUser'   => DI()->userInfo['userId'],
                'updateTime'   => date('Y-m-d H:i:s'),
            );
        }else{
            $input = array(
                'reviewer'     => $reviewer,
                'reviewerMemo' => '',
                'updateUser'   => DI()->userInfo['userId'],
                'updateTime'   => date('Y-m-d H:i:s'),
                'reviewerTime' => date('Y-m-d H:i:s'),
                'flag'     => $flag,
            );
        }
        try {
            DI()->notorm->beginTransaction('db_demo');

            $num = $model->update($orderId, $input); // TODO: Change the autogenerated stub
            if (!$num) {
                throw new PDOException('提交失败', 1);
            }

            $log_model = new Model_LogOrder();
            $num = $log_model->insert(array(
                'logUser'    => DI()->userInfo['userId'],
                'logType'    => 'TOREVIEW',
                'logContent' => json_encode($input),
                'orderId'    => $orderId,
                'orderType'  => DI()->request->get('type'),
                'createTime' => date('Y-m-d H:i:s')
            ));
            if (!$num) {
                throw new PDOException('日志保存失败', 1);
            }

            //通知审核人

            $content = $this->toReviewerMsg($order['orderNo'], $order['totalMoney'], $order['createTime']);
            if (!Domain_Message_Msg::send($order['createUser'], $reviewer, $content, 3, $order['createCompany'])) {
                throw new PDOException('通知失败', 1);
            }
            if (in_array($this->type, array('PURCHASE_IN', 'ALLOT_IN'))) {
                //入库
                $input['depot_goods'] = $this->addToDepot($orderId,$type=$this->type);
                //库存日志
                $this->depotLog(1, $input['depot_goods'],$orderId);
                //生成采购发票
                if ($this->type == 'PURCHASE_IN') {
                    $this->createInvoice($order);
                }
                Domain_Message_Msg::depotWarningCreate($order['createCompany'], $reviewer,$input['depot_goods'],$this->type);
            }else if(in_array($this->type, array('USE_OUT', 'ALLOT_OUT'))){
                //商品出库
                $input['depot_goods'] =  $this->outDepot($orderId);
                //库存日志
                $log_model = new Model_LogDepot();
                $num = $log_model->insert(array(
                    'logUser'    => DI()->userInfo['userId'],
                    'logType'    => 2,
                    'logContent' => json_encode( $input['depot_goods']),
                    'depotId'    => ($this->type == 'SALE_OUT') ? 0 : $order['depotId'],
                    'orderId'    => $orderId,
                    'orderType'  => $this->type,
                    'createTime' => date('Y-m-d H:i:s')
                ));
                if (!$num) {
                    throw new PDOException('库存日志错误', 1);
                }
                //库存预警
                Domain_Message_Msg::depotWarningCreate($order['createCompany'], $reviewer,$input['depot_goods'],$this->type);
            }else if(in_array($this->type, array('USE_RETURN'))){
                //商品退货
                $input['depot_goods'] = $this->useReturn($orderId);
                $log_model = new Model_LogDepot();
                $num = $log_model->insert(array(
                    'logUser'    => DI()->userInfo['userId'],
                    'logType'    => 1,
                    'logContent' => json_encode( $input['depot_goods']),
                    'depotId'    => $order['depotId'],
                    'orderId'    => $orderId,
                    'orderType'  => $this->type,
                    'createTime' => date('Y-m-d H:i:s')
                ));
                if (!$num) {
                    throw new PDOException('库存日志错误', 1);
                }
                Domain_Message_Msg::depotWarningCreate($order['createCompany'], $reviewer,$input['depot_goods'],$this->type);
            }else if(in_array($this->type, array('PURCHASE_RETURN'))) {
                //商品退货
                $input['depot_goods'] = $this->ipReturn($orderId);
                $log_model = new Model_LogDepot();
                $num = $log_model->insert(array(
                    'logUser'    => DI()->userInfo['userId'],
                    'logType'    => 1,
                    'logContent' => json_encode( $input['depot_goods']),
                    'depotId'    => $order['depotId'],
                    'orderId'    => $orderId,
                    'orderType'  => $this->type,
                    'createTime' => date('Y-m-d H:i:s')
                ));
                if (!$num) {
                    throw new PDOException('库存日志错误', 1);
                }
                Domain_Message_Msg::depotWarningCreate($order['createCompany'], $reviewer,$input['depot_goods'],$this->type);
            }

            DI()->notorm->commit('db_demo');

            return true;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_BadRequest($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('服务器错误', 0);
        }
    }
    /**
     * 库存日志
     * @param $type
     * @param $logContent
     * @return long|string
     */
    protected function depotLog($type, $logContent,$orderId)
    {
        $log_model = new Model_LogDepot();
        $num = $log_model->insert(array(
            'logUser'    => DI()->userInfo['userId'],
            'logType'    => $type,
            'logContent' => json_encode($logContent),
            'depotId'    => ($this->type == 'SALE_OUT') ? 0 : $this->order['depotId'],
            'orderId'    => $orderId,
            'orderType'  => $this->type,
            'createTime' => date('Y-m-d H:i:s')
        ));
        if (!$num) {
            throw new PDOException('库存日志错误', 1);
        }

        $this->depotLog_model = $log_model;
        return $num;
    }
    /**
     * 商品入库
     * @return array
     */
    protected function addToDepot($orderId,$type)
    {
        $depot_input = array();          //入库商品
        $price = array();                //历史价格

        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }

        $order_model = new Model_Order();
        $order = $order_model->get($orderId);
        $this->order = $order;
        $this->type = $type;
        $model = new Model_Goods();
        $depotSub_model = new Model_DepotSub();
        foreach ($goods as $g) {
            if($this->type == 'PURCHASE_IN'){
                $depot_input[] = array(
                    'batchNo'       => $g['orderSubNo'],
                    'depotId'       => ($this->type == 'PURCHASE_IN') ? $g['depotId'] : $this->order['depotId'],
                    'depotSubId'    => $g['depotSubId'],
                    'supplierId'    => $g['supplierId'],
                    'goodsId'       => $g['goodsId'],
                    'goodsPrice'    => $g['goodsPrice'],
                    'usecostpri'    => $g['usecostpri'],
                    'goodsCnt'      => $g['goodsCnt'],
                    'flag'          => 1,
                    'createCompany' => DI()->userInfo['companyId'],
                    'createUser'    => DI()->userInfo['userId'],
                    'createTime'    => date('Y-m-d H:i:s'),
                );
            }else{
                $depot_input[] = array(
                    'batchNo'       => $g['orderSubNo'],
                    'depotId'       => ($this->type == 'PURCHASE_IN') ? $g['depotId'] : $this->order['depotId'],
                    'depotSubId'    => $g['depotSubId'],
                    'supplierId'    => $g['supplierId'],
                    'goodsId'       => $g['goodsId'],
                    'goodsPrice'    => $g['goodsPrice'],
                    'goodsCnt'      => $g['goodsCnt'],
                    'flag'          => 1,
                    'createCompany' => DI()->userInfo['companyId'],
                    'createUser'    => DI()->userInfo['userId'],
                    'createTime'    => date('Y-m-d H:i:s'),
                );
            }

            // 验证仓库是否存在
            $depotSub = $depotSub_model->fetch($g['depotSubId']);
            if (!$depotSub || $depotSub['flag'] != 1) {
                throw new PDOException('库位不存在', 1);
            }
            if ($depotSub['companyId'] != $this->order['createCompany']) {
                throw new PDOException('库位:' . $depotSub['depotSubName'] . '不属于该订单公司', 1);
            }
            if ($this->type == 'PURCHASE_IN') {
                //历史价格
                if (!isset($price[$g['goodsId']])) {
                    $goods = $model->fetch($g['goodsId']);

                    $price[$g['goodsId']]['minPrice'] = $goods['minPrice'];
                    $price[$g['goodsId']]['maxPrice'] = $goods['maxPrice'];
                    $price[$g['goodsId']]['usecostpri'] = $g['usecostpri'];

                    if (!$goods) {
                        throw new PDOException('批次号：' . $g['batchNo'] . '商品不存在', 1);
                    }

                    $price[$g['goodsId']]['lastPrice'] = $g['goodsPrice'];

                    if ($goods['minPrice'] > $g['goodsPrice']) {
                        $price[$g['goodsId']]['minPrice'] = $g['goodsPrice'];
                    }
                    if ($goods['minPrice'] == 0) {
                        $price[$g['goodsId']]['minPrice'] = $g['goodsPrice'];
                    }
                    if ($g['goodsPrice'] > $goods['maxPrice']) {
                        $price[$g['goodsId']]['maxPrice'] = $g['goodsPrice'];
                    }
                    $total = $model->getTotalPoPrice($g['goodsId']);

                    $price[$g['goodsId']]['totalMoney'] = $total[0]['totalMoney'] ? $total[0]['totalMoney'] : $g['goodsPrice'];
                    $price[$g['goodsId']]['count'] = $total[0]['count'];
                    //价格预警
                    $content = Domain_Message_Msg::priceWarning($goods['goodsId'], $this->order['createCompany'],
                        $goods['lastPrice'], $g['goodsPrice'], $goods['goodsName']);
                    if ($content && !Domain_Message_Msg::send(0, $this->order['reviewer'], json_encode($content), 2,
                            $this->order['createCompany'])
                    ) {
                        throw new PDOException('消息错误', 1);
                    }

                } else {
                    $price[$g['goodsId']]['lastPrice'] = $g['goodsPrice'];

                    if ($price[$g['goodsId']]['minPrice'] > $g['goodsPrice']) {
                        $price[$g['goodsId']]['minPrice'] = $g['goodsPrice'];
                    }
                    if ($g['goodsPrice'] > $price[$g['goodsId']]['minPrice']) {
                        $price[$g['goodsId']]['maxPrice'] = $g['goodsPrice'];
                    }
                }

            }
        }
        //入库
        $depot_model = new Model_DepotGoods();
        $nums = $depot_model->insert_multi($depot_input);
        if (!$nums) {
            throw new PDOException('入库失败', 1);
        }
        //更新产品价格
        if ($this->type == 'PURCHASE_IN') {
            foreach ($price as $id => $g) {
                $id = $model->update($id, array(
                    'lastPrice' => $g['lastPrice'],
                    'minPrice'  => $g['minPrice'],
                    'maxPrice'  => $g['maxPrice'],
                    'usecostpri'  => $g['usecostpri'],
                    'avgPrice'  => sprintf('%.2f', $g['totalMoney'] / $g['count']),
                ));
                if ($id === false) {
                    throw new PDOException('产品价格更新失败', 1);
                }
            }
        }
        return $depot_input;
    }
    protected function ipReturn($orderId)
    {
        $input = array();
        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }
        $reGoods = array();
        $usingGoods = array();
        foreach ($goods as $k=>$v){
            $reGoods[$v['goodsId']][$v['orderSubNo']]['goodsCnt'] = $v['goodsCnt'];
            $reids[] = $v['orderSubNo'];
        }
        //退货商品不存在于出库商品中
        $ipGoods = $goods_model->getIpGoods($orderId);
        foreach ($ipGoods as $kk=>$vv) {
            $usingGoods[$vv['goodsId']][$vv['orderSubNo']]['goodsCnt'] = $vv['goodsCnt'];
            if(isset($reGoods[$vv['goodsId']][$vv['orderSubNo']]  )){
                if($usingGoods[$vv['goodsId']][$vv['orderSubNo']]['goodsCnt']<$reGoods[$vv['goodsId']][$vv['orderSubNo']]['goodsCnt']){
                    throw new PDOException('商品数量大于出库数量', 1);
                    break;
                }
            }
            $usingids[] = $vv['orderSubNo'];
        }
        $diffids = array_diff($reids,$usingids);
        if(!empty($diffids)){
            throw new PDOException('商品不存在于出库清单中', 1);
        }
        //入库，更改库存
        $depotGoods_model = new Model_DepotGoods();
        foreach ($goods as $g) {
            $depot_goods = $depotGoods_model->getGoodsInfo($g['goodsId'],$g['orderSubNo'],$g['depotId']);
            if (!$depot_goods || $depot_goods['flag'] != 1) {
                throw new PDOException('库存商品不存在', 1);
                break;
            }
            $goodsInfo_model = new Model_Goods();
            $goodsinfo = $goodsInfo_model->fetch($depot_goods['goodsId']);
            $num = DI()->notorm->depot_goods->where('goodsId', $g['goodsId'])->where('batchNo', $g['orderSubNo'])->where('depotId', $g['depotId'])->update(array('goodsCnt' => new NotORM_Literal("goodsCnt - $g[goodsCnt]")));
            if ($num === false) {
                throw new PDOException('库存更新失败', 1);
                break;
            }
            $input[] = array(
                'id'         => $depot_goods['id'],
                'depotSubId' => $g['depotSubId'],
                'batchNo'    => $depot_goods['batchNo'],
                'goodsCnt'   => $g['goodsCnt'],
                'depotId' => $g['depotId'],
                'goodsId' => $g['goodsId'],
                'createCompany' => $g['createCompany']
            );
        }
        return $input;
    }
    protected function useReturn($orderId)
    {
        $input = array();
        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }
        $reGoods = array();
        $usingGoods = array();
        foreach ($goods as $k=>$v){
            $reGoods[$v['goodsId']][$v['orderSubNo']]['goodsCnt'] = $v['goodsCnt'];
            $reids[] = $v['orderSubNo'];
        }
        //退货商品不存在于出库商品中

        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }
        $useGoods = $goods_model->getUseaGoods($orderId);
        foreach ($useGoods as $kk=>$vv) {
            $usingGoods[$vv['goodsId']][$vv['orderSubNo']]['goodsCnt'] = $vv['goodsCnt'];
            if(isset($reGoods[$vv['goodsId']][$vv['orderSubNo']]  )){
                if($usingGoods[$vv['goodsId']][$vv['orderSubNo']]['goodsCnt']<$reGoods[$vv['goodsId']][$vv['orderSubNo']]['goodsCnt']){
                    throw new PDOException('商品数量大于出库数量', 1);
                    break;
                }
            }
            $usingids[] = $vv['orderSubNo'];
        }
        $diffids = array_diff($reids,$usingids);
        if(!empty($diffids)){
            throw new PDOException('商品不存在于出库清单中', 1);
        }
        //入库，更改库存
        $depotGoods_model = new Model_DepotGoods();
        foreach ($goods as $g) {
            $depot_goods = $depotGoods_model->get($g['depotGoodsId']);
            if (!$depot_goods || $depot_goods['flag'] != 1) {
                throw new PDOException('库存商品不存在', 1);
                break;
            }
            $goodsInfo_model = new Model_Goods();
            $goodsinfo = $goodsInfo_model->fetch($depot_goods['goodsId']);
            $num = DI()->notorm->depot_goods->where('id', $g['depotGoodsId'])->update(array('goodsCnt' => new NotORM_Literal("goodsCnt + $g[goodsCnt]")));
            if ($num === false) {
                throw new PDOException('库存更新失败', 1);
                break;
            }
            $input[] = array(
                'id'         => $g['depotGoodsId'],
                'depotSubId' => $g['depotSubId'],
                'batchNo'    => $depot_goods['batchNo'],
                'goodsCnt'   => $g['goodsCnt'],
                'depotId' => $g['depotId'],
                'goodsId' => $g['goodsId'],
                'createCompany' => $g['createCompany']
            );
        }
        return $input;
    }

    /**
     * 商品出库
     * @return array
     */
    protected function outDepot($orderId)
    {
        $input = array();

        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }

        $depotGoods_model = new Model_DepotGoods();

        foreach ($goods as $g) {
            $depot_goods = $depotGoods_model->get($g['depotGoodsId']);
            if (!$depot_goods || $depot_goods['flag'] != 1) {
                throw new PDOException('库存商品不存在', 1);
                break;
            }
            $goodsInfo_model = new Model_Goods();
            $goodsinfo = $goodsInfo_model->fetch($depot_goods['goodsId']);
            if ($depot_goods['goodsCnt'] < $g['goodsCnt']) {
                throw new PDOException($depot_goods['batchNo'].'批次的'.$goodsinfo['goodsName'].'库存不足,库存：' . $depot_goods['goodsCnt'], 1);
                break;
            }
            $num = $depotGoods_model->update($g['depotGoodsId'], array(
                'goodsCnt' => new NotORM_Literal('goodsCnt-' . $g['goodsCnt'])
            ));
            if ($num === false) {
                throw new PDOException('库存更新失败', 1);
                break;
            }

            $input[] = array(
                'id'         => $g['depotGoodsId'],
                'depotSubId' => $g['depotSubId'],
                'depotId' => $g['depotId'],
                'goodsId' => $g['goodsId'],
                'batchNo'    => $depot_goods['batchNo'],
                'createCompany' => $g['createCompany'],
                'goodsCnt'   => $g['goodsCnt']
            );
        }

        return $input;
    }

    protected function createInvoice($order)
    {
        $this->order = $order;
        $input = array(
            'invoiceNo'     => 'IN' . date('ymdHis') . rand(1000, 9999),
            'orderId'       => $this->order['orderId'],
            'supplierId'    => $this->order['supplierId'],
            'totalMoney'    => $this->order['totalMoney'],
            'companyId'     => $this->order['createCompany'],
            'flag'          => 1,
            'createTime'    => date('Y-m-d H:i:s'),
            'createUser'    => DI()->userInfo['userId'],
            'createCompany' => DI()->userInfo['companyId']
        );

        $invoiceId = DI()->notorm->invoices->insert($input);
        if (!$invoiceId) {
            throw new PDOException('采购发票生成失败', 1);
        }

        return $invoiceId;
    }

    public function toReviewerMsg($orderNo, $totalMoney, $createTime)
    {
        $prefix = array(
            'PLAN'        => '采购计划单',   //采购计划单
            'ARRIVAL'     => '到货单',   //到货单
            'RETURN'      => '退货单',   //退货单
            'PURCHASE_IN' => '采购入库单',   //采购入库单
            'OTHER_IN'    => '其他入库单',   //其他入库单
            'ALLOT_IN'    => '调拨入库单',   //调拨入库单
            'ALLOT_OUT'   => '调拨出库单',   //调拨出库单
            'USE_OUT'     => '领用出库单',   //领用出库单
            'OTHER_OUT'   => '其他出库单',   //其他出库单
            'INVENTORY'   => '盘点单',    //盘点单,
            'SALE_OUT'    => '销售单',
            'SALE_RETURN' => '销售退货单',
            'USE_RETURN' => '领用退货单',
            'PURCHASE_RETURN' => '采购退货单'
        );

        return $prefix[$this->type] . '待审核：单号:' . $orderNo . ',金额:' . $totalMoney . ',时间:' . $createTime;
    }
}
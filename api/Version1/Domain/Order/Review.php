<?php

class Domain_Order_Review
{
    protected $type;                    //订单类型
    protected $result;                  //审核结果
    protected $order;                   //订单信息
    protected $memo;                    //审核备注
    protected $orderId;                 //订单ID
    protected $flag;                    //审核状态
    protected $order_model;             //订单Model
    protected $orderGoods_model;        //订单商品Model
    protected $orderLog_model;          //订单日志Model
    protected $depotLog_model;          //库存日志Model

    public function __construct($data)
    {
        $this->type = $data['type'];
        $this->result = $data['result'];
        $this->orderId = $data['orderId'];
        $this->memo = $data['memo'];
        $this->getResult($data['result']);
    }

    /**
     * 获取审核状态
     * @param $result
     * @throws PhalApi_Exception_BadRequest
     */
    protected function getResult($result)
    {
        $rs = array(
            'pass'   => 3,
            'nopass' => -3
        );
        if (array_key_exists($result, $rs)) {
            $this->flag = $rs[$result];
            return;
        }
        throw new PhalApi_Exception_BadRequest('invalid result', 0);
    }

    /**
     * 审核
     * @return bool
     * @throws PhalApi_Exception_BadRequest
     * @throws PhalApi_Exception_InternalServerError
     */
    public function review()
    {
        $order_model = new Model_Order();

        $order = $order_model->get($this->orderId);
        if (!$order) {
            throw new PhalApi_Exception_BadRequest('订单不存在!', 0);
        }
        if ($order['flag'] != 1) {
            throw new PhalApi_Exception_BadRequest('订单状态错误!', 0);
        }

        $this->order_model = $order_model;
        $this->order = $order;

        if (DI()->userInfo['userGroup'] != 1 && DI()->userInfo['userId'] != $order['reviewer']) {
            throw new PhalApi_Exception_BadRequest('没有权限!', 0);
        }
        try {
            DI()->notorm->beginTransaction('db_demo');

            if (in_array($this->type, array('PLAN', 'ARRIVAL', 'RETURN'))) {
                $this->workA();
            }

            if (in_array($this->type, array('PURCHASE_IN', 'ALLOT_IN'))) {
                $this->workB();
            }

            if (in_array($this->type, array('USE_OUT', 'ALLOT_OUT', 'SALE_OUT'))) {
                $this->workC();
            }

            if ($this->type == 'INVENTORY') {
                $this->workD();
            }

            if (in_array($this->type, array('OTHER_IN', 'OTHER_OUT'))) {
                $this->workE();
            }

            DI()->notorm->commit('db_demo');
            return true;
        } catch (PDOException $e) {
            error_log(print_r($e->getMessage(), 1));
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_BadRequest($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('异常', 0);
        }
    }

    /**
     * '采购单', '进货单', '退货单' 审核流程
     * @return mixed
     */
    protected function workA()
    {
        //更新订单审核信息
        $input['review'] = $this->updateReviewer();
        //订单日志
        $this->orderLog($input['review']);
        //通知订单创建人

        return $input;
    }


    /**
     * '采购入库单', '调拨入库单' 审核流程
     * @return mixed
     */
    protected function workB()
    {
        //更新审核信息
        $input['review'] = $this->updateReviewer();
        //订单日志
        $this->orderLog($input['review']);
        //审核通过
        if ($this->flag == 3) {
            //商品入库
            $input['depot_goods'] = $this->addToDepot();
            //库存日志
            $this->depotLog(1, $input['depot_goods']);
            //生成采购发票
            if ($this->type == 'PURCHASE_IN') {
                $this->createInvoice();
            }
        }
        //通知订单创建人?

        return $input;
    }

    //生成采购发票
    protected function createInvoice()
    {

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

        $model = new Model_Invoice();
        $invoiceId = $model->insert($input);
        if (!$invoiceId) {
            throw new PDOException('采购发票生成失败', 1);
        }

        return $invoiceId;
    }


    /**
     * '领用出库单', '调拨出库单' 审核流程
     * @return mixed
     */
    protected function workC()
    {
        //更新审核信息
        $input['review'] = $this->updateReviewer();
        //订单日志
        $this->orderLog($input['review']);
        //审核通过
        if ($this->flag == 3) {
            //商品出库
            $input['depot_goods'] = $this->outDepot();
            //库存日志
            $this->depotLog(2, $input['depot_goods']);
            //库存预警
            Domain_Message_Msg::depotWarning($this->order['createCompany'], $this->order['reviewer']);
            if ($this->type == 'SALE_OUT') {
                //生成销售发票
                $input = array(
                    'invoiceNo'     => 'IN' . date('ymdHis') . rand(1000, 9999),
                    'orderId'       => $this->order['orderId'],
                    'supplierId'    => $this->order['customerId'],
                    'totalMoney'    => $this->order['totalMoney'],
                    'companyId'     => $this->order['createCompany'],
                    'flag'          => 1,
                    'createTime'    => date('Y-m-d H:i:s'),
                    'createUser'    => DI()->userInfo['userId'],
                    'createCompany' => DI()->userInfo['companyId'],
                    'invoiceStatus' => 1,
                    'type'          => 2
                );

                $model = new Model_Invoice();
                $invoiceId = $model->insert($input);
                if (!$invoiceId) {
                    throw new PDOException('采购发票生成失败', 1);
                }
            }
        }

        //通知 订单创建人
        return $input;
    }


    /**
     * '盘点单' 审核流程
     * @return mixed
     */
    protected function workD()
    {
        //更新审核信息
        $input['review'] = $this->updateReviewer();
        //订单日志
        $this->orderLog($input['review']);
        //审核通过
        if ($this->flag == 3) {
            //对比库存 生成其他出库 入库单
            $this->compare();

        }
        //通知


        return $input;
    }


    protected function workE()
    {
        //更新审核状态
        $input['review'] = $this->updateReviewer();
        //订单日志
        $this->orderLog($input['review']);

        if ($this->flag == 3) {
            //更新库存
            $input['depot_goods'] = $this->updateDepotGoods();

            $type = $this->type == 'OTHER_IN' ? 1 : 2;

            $this->depotLog($type, $input['depot_goods']);

            if ($this->type == 'OTHER_OUT') {
                Domain_Message_Msg::depotWarning($this->order['createCompany'], $this->order['reviewer']);
            }
        }

        return $input;
    }


    /**
     * 当前订单日志
     * @param $logContent
     * @return long|string
     */
    protected function orderLog($logContent)
    {
        //审核日志
        $log_model = new Model_LogOrder();
        $num = $log_model->insert(array(
            'logUser'    => DI()->userInfo['userId'],
            'logType'    => strtoupper($this->result),
            'logContent' => json_encode($logContent),
            'orderId'    => $this->orderId,
            'orderType'  => $this->type,
            'createTime' => date('Y-m-d H:i:s')
        ));
        if (!$num) {
            throw new PDOException('订单日志错误', 1);
        }

        $this->orderLog_model = $log_model;
        return $num;
    }

    /**
     * 库存日志
     * @param $type
     * @param $logContent
     * @return long|string
     */
    protected function depotLog($type, $logContent)
    {
        $log_model = new Model_LogDepot();

        $num = $log_model->insert(array(
            'logUser'    => DI()->userInfo['userId'],
            'logType'    => $type,
            'logContent' => json_encode($logContent),
            'depotId'    => ($this->type == 'SALE_OUT') ? 0 : $this->order['depotId'],
            'orderId'    => $this->orderId,
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
     * 更新订单审核信息
     * @return array
     */
    protected function updateReviewer()
    {
        $input = array(
            'reviewer'     => DI()->userInfo['userId'],
            'reviewerTime' => date('Y-m-d H:i:s'),
            'reviewerMemo' => $this->memo,
            'flag'         => $this->flag,
            'updateTime'   => date('Y-m-d H:i:s'),
            'updateUser'   => DI()->userInfo['userId'],
        );

        $num = $this->order_model->update($this->orderId, $input);
        if (!$num) {
            throw new PDOException('审核失败', 1);
        }

        return $input;
    }


    protected function updateDepotGoods()
    {
        $depot_input = array();

        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($this->orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }

        $depotGoods_model = new Model_DepotGoods();
        foreach ($goods as $g) {

            if ($this->type == 'OTHER_IN') {
                $input = array('goodsCnt' => new NotORM_Literal('goodsCnt+' . $g['goodsCnt']));
            } else {
                $input = array('goodsCnt' => new NotORM_Literal('goodsCnt-' . $g['goodsCnt']));
            }

            $num = $depotGoods_model->update($g['depotGoodsId'], $input);
            if ($num === false) {
                throw new PDOException('库存更新失败', 1);
            }

            $depot_input[] = array(
                'id'         => $g['depotGoodsId'],
                'batchNo'    => $g['orderSubNo'],
                'depotSubId' => $g['depotSubId'],
                'goodsCnt'   => $g['goodsCnt'],
            );
        }

        return $depot_input;
    }

    /**
     * 商品入库
     * @return array
     */
    protected function addToDepot()
    {
        $depot_input = array();          //入库商品
        $price = array();                //历史价格

        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($this->orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }

        $model = new Model_Goods();
        $depotSub_model = new Model_DepotSub();

        foreach ($goods as $g) {
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
                    'avgPrice'  => sprintf('%.2f', $g['totalMoney'] / $g['count']),
                ));
                if ($id === false) {
                    throw new PDOException('产品价格更新失败', 1);
                }
            }
        }
        return $depot_input;
    }

    /**
     * 商品出库
     * @return array
     */
    protected function outDepot()
    {
        $input = array();

        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($this->orderId);
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
            if ($depot_goods['goodsCnt'] < $g['goodsCnt']) {
                throw new PDOException('库存商品不足,库存：' . $depot_goods['goodsCnt'], 1);
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
                'batchNo'    => $depot_goods['batchNo'],
                'goodsCnt'   => $g['goodsCnt']
            );
        }

        return $input;
    }


    /**
     * 库存比较
     * @return mixed
     */
    protected function compare()
    {
        //其他出库单
        $out_input = array(
            'orderId'    => 0,
            'totalMoney' => 0,
            'totalCnt'   => 0,
            'goods'      => array()
        );
        //其他入库单
        $in_input = array(
            'orderId'    => 0,
            'totalMoney' => 0,
            'totalCnt'   => 0,
            'goods'      => array()
        );

        //订单商品
        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getAll($this->orderId);
        if (!$goods) {
            throw new PDOException('订单商品不存在', 1);
        }

        $this->orderGoods_model = $goods_model;

        $depotGoods_model = new Model_DepotGoods();

        foreach ($goods as $g) {
            $depot_goods = $depotGoods_model->get($g['depotGoodsId']);
            if (!$depot_goods || $depot_goods['flag'] != 1) {
                throw new PDOException('库存商品不存在', 1);
                break;
            }

            if ($depot_goods['goodsCnt'] < $g['goodsCnt']) {
                //其他入库单
                if (empty($in_input['orderId'])) {
                    $orderId = $this->otherCreate('OTHER_IN');
                    $in_input['orderId'] = $orderId;
                }

                $in_input['goods'][] = array(
                    'orderId'       => $in_input['orderId'],
                    'orderSubNo'    => $depot_goods['batchNo'],
                    'depotGoodsId'  => $depot_goods['id'],
                    'depotId'       => $this->order['depotId'],
                    'goodsId'       => $depot_goods['goodsId'],
                    'supplierId'    => $depot_goods['supplierId'],
                    'depotSubId'    => $depot_goods['depotSubId'],
                    'goodsPrice'    => $depot_goods['goodsPrice'],
                    'goodsCnt'      => ($g['goodsCnt'] - $depot_goods['goodsCnt']),
                    'flag'          => 1,
                    'createCompany' => DI()->userInfo['companyId'],
                    'createUser'    => DI()->userInfo['userId'],
                    'createTime'    => date('Y-m-d H:i:s')
                );

                $in_input['totalMoney'] += $depot_goods['goodsPrice'] * ($g['goodsCnt'] - $depot_goods['goodsCnt']);
                $in_input['totalCnt'] += ($g['goodsCnt'] - $depot_goods['goodsCnt']);

                //通知异常库存
                if (!Domain_Message_Msg::depotError(($g['goodsCnt'] - $depot_goods['goodsCnt']),
                    $depot_goods['depotSubId'], $depot_goods['batchNo'], $this->order['reviewer'],
                    $this->order['createCompany'], $this->type)
                ) {
                    throw new PDOException('消息异常', 1);
                }
            }
            if ($depot_goods['goodsCnt'] > $g['goodsCnt']) {
                //其他出库单
                if (empty($out_input['orderId'])) {
                    $orderId = $this->otherCreate('OTHER_OUT');
                    $out_input['orderId'] = $orderId;
                }

                $out_input['goods'][] = array(
                    'orderId'       => $out_input['orderId'],
                    'orderSubNo'    => $depot_goods['batchNo'],
                    'depotGoodsId'  => $depot_goods['id'],
                    'goodsId'       => $depot_goods['goodsId'],
                    'supplierId'    => $depot_goods['supplierId'],
                    'depotId'       => $this->order['depotId'],
                    'depotSubId'    => $depot_goods['depotSubId'],
                    'goodsPrice'    => $depot_goods['goodsPrice'],
                    'goodsCnt'      => ($depot_goods['goodsCnt'] - $g['goodsCnt']),
                    'flag'          => 1,
                    'createCompany' => DI()->userInfo['companyId'],
                    'createUser'    => DI()->userInfo['userId'],
                    'createTime'    => date('Y-m-d H:i:s')
                );

                $out_input['totalMoney'] += $depot_goods['goodsPrice'] * ($depot_goods['goodsCnt'] - $g['goodsCnt']);
                $out_input['totalCnt'] += ($depot_goods['goodsCnt'] - $g['goodsCnt']);

                //通知异常库存
                if (!Domain_Message_Msg::depotError(($depot_goods['goodsCnt'] - $g['goodsCnt']),
                    $depot_goods['depotSubId'], $depot_goods['batchNo'], $this->order['reviewer'],
                    $this->order['createCompany'], $this->type)
                ) {
                    throw new PDOException('消息异常', 1);
                }
            }
        }

        if (!empty($out_input['goods'])) {
            //更新其他出库单
            $this->otherInsert($out_input, 'OTHER_OUT');
        }

        if (!empty($in_input['goods'])) {
            //更新其他入库库单
            $this->otherInsert($in_input, 'OTHER_IN');
        }

        return $this->orderId;
    }


    /**
     * 其他出入库单创建
     * @param $type
     * @return mixed
     */
    protected function otherCreate($type)
    {
        $prefix = $type == 'OTHER_OUT' ? 'OQ' : 'IQ';

        $input = array();
        $input['orderNo'] = $prefix . date('ymdHis') . rand(1000, 9999);
        $input['depotId'] = $this->order['depotId'];
        $input['totalMoney'] = 0;
        $input['totalCnt'] = 0;
        $input['flag'] = 0;
        $input['reviewer'] = $this->order['reviewer'];
        $input['createCompany'] = DI()->userInfo['companyId'];
        $input['createUser'] = DI()->userInfo['userId'];
        $input['createTime'] = date('Y-m-d H:i:s');

        $orderId = $this->order_model->addOther($type, $input);
        if (!$orderId) {
            $msg = $type == 'OTHER_OUT' ? '其他出库单' : '其他入库单';
            throw new PDOException($msg . '创建失败', 1);
        }

        $logId = $this->orderLog_model->insert(array(
            'logUser'    => DI()->userInfo['userId'],
            'logType'    => 'CREATE',
            'logContent' => json_encode($input),
            'orderId'    => $orderId,
            'orderType'  => $type,
            'createTime' => date('Y-m-d H:i:s')
        ));
        if (!$logId) {
            throw new PDOException('订单日志错误', 1);
        }

        //通知审核人
        $saveDomain = new Domain_Order_Save($type);
        $content = $saveDomain->toReviewerMsg($input['orderNo'], $input['totalMoney'], $input['createTime']);
        if (!Domain_Message_Msg::send($input['createUser'], $this->order['reviewer'], $content, 3,
            $input['createCompany'])
        ) {
            throw new PDOException('通知失败', 1);
        }

        return $orderId;
    }

    /**
     * 其他出入库单 商品插入
     * @param $input
     * @param $type
     * @return mixed
     */
    protected function otherInsert($input, $type)
    {
        //更新其他出库单
        $nums = $this->orderGoods_model->insert_multi($type, $input['goods']);
        $msg = $type == 'OTHER_OUT' ? '其他出库单' : '其他入库单';

        if (!$nums || $nums != count($input['goods'])) {
            throw new PDOException($msg . '保存失败', 1);
        }
        //更新订单
        $num = $this->order_model->updateOther($type, $input['orderId'], array(
            'totalMoney' => $input['totalMoney'],
            'totalCnt'   => $input['totalCnt'],
            'flag'       => 1
        ));
        if (!$num) {
            throw new PDOException($msg . '更新失败', 1);
        }
        //日志
        $num = $this->orderLog_model->insert(array(
            'logUser'    => DI()->userInfo['userId'],
            'logType'    => 'INSERT',
            'logContent' => json_encode($input),
            'orderId'    => $input['orderId'],
            'orderType'  => $type,
            'createTime' => date('Y-m-d H:i:s')
        ));
        if (!$num) {
            throw new PDOException('订单日志错误', 1);
        }

        return $input['orderId'];
    }
}
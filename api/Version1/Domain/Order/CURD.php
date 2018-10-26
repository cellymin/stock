<?php

class Domain_Order_CURD
{

    private $dbname; //表名

    private $no_prefix; //订单编号前缀

    private $type;

    private $goods_dbname;

    private $order;

    private $reviewRole;

    public function __construct($type)
    {
        $this->type = $type;
        $this->dbname = $this->getDB();
        $this->no_prefix = $this->getPrefix();
        $this->goods_dbname = str_replace('orders', 'goods', $this->dbname);
        $this->reviewRole = $this->getReviewRole();
    }

    //获取未保存订单
    public function getNotSave()
    {
        $order_model = new Model_Order();

        $order = $order_model->getNotSaveByUserId($this->dbname);
        if (!$order) {
            $orderNo = $this->no_prefix . date('ymdHis') . rand(1000, 9999);

            $input = array(
                'orderNo' => $orderNo,
                'createCompany' => DI()->userInfo['companyId'],
                'createUser' => DI()->userInfo['userId'],
                'createTime' => date('Y-m-d H:i:s'),
            );
            if ($this->type == "PURCHASE_IN") {
                $batchNo = 'BP' . date('ymd') . '00001';
                $order = $order_model->getLastOrder($this->dbname);
                if ($order) {
                    $batchNo = str_replace('BP', '', $order['batchNo']);
                    $batchNo = 'BP' . ($batchNo + 1);
                }
                $input['batchNo'] = $batchNo;
            }

            $orderId = $order_model->create($this->dbname, $input);
            if ($orderId === false) {
                return false;
            }
            //订单日志
            $log_model = new Model_LogOrder();
            $log_model->insert(array(
                'logUser' => DI()->userInfo['userId'],
                'logType' => '新建订单',
                'logContent' => json_encode($input),
                'orderId' => $orderId,
                'orderType' => $this->type,
                'createTime' => date('Y-m-d H:i:s')
            ));

            $order = $order_model->getNotSaveByUserId($this->dbname);
        }
        $order_goods_model = new Model_OrderGoods();
        $order['sub'] = $order_goods_model->getByOrderId($order['orderId'], $this->goods_dbname);
        return $order;
    }

    //登记商品
    public function add($params)
    {
        $this->chkAddParams($params);
        $input = $this->getAddData($params);

        $input['flag'] = 1;
        $input['createCompany'] = DI()->userInfo['companyId'];
        $input['createUser'] = DI()->userInfo['userId'];
        $input['createTime'] = date('Y-m-d H:i:s');

        try {
            DI()->notorm->beginTransaction('db_demo');

            $order_goods_model = new Model_OrderGoods();

            if ($this->type == "PURCHASE_IN") {
                $subBatchNo = $this->order['batchNo'] . '001';

                $order_goods = $order_goods_model->getLastGoods($this->goods_dbname, $input['orderId']);
                if ($order_goods) {
                    $subBatchNo = str_replace('BP', '', $order_goods['subBatchNo']);
                    $subBatchNo = 'BP' . ($subBatchNo + 1);
                }
                $input['subBatchNo'] = $subBatchNo;
            }

            $id = $order_goods_model->add($input, $this->goods_dbname);

            //更新订单总金额 数量
            $update_input = array(
                'totalMoney' => new NotORM_Literal('totalMoney+' . $input['goodsPrice'] * $input['goodsCnt']),
                'totalCnt' => new NotORM_Literal('totalCnt+' . $input['goodsCnt']),
                'updateUser' => DI()->userInfo['userId'],
                'updateTime' => date('Y-m-d H:i:s')
            );
            $order_model = new Model_Order();
            $order_model->edit($this->dbname, $input['orderId'], $update_input);

            $order = $order_model->getById($this->dbname, $input['orderId']);
            $goods = $order_goods_model->getById($this->goods_dbname, $id);

            $supplier_model = new Model_Supplier();
            $supplier = $supplier_model->getById($goods['supplierId']);

            DI()->notorm->commit('db_demo');

            return array(
                'orderId' => $order['orderId'],
                'totalMoney' => $order['totalMoney'],
                'totalCnt' => $order['totalCnt'],
                'goods' => $goods
            );
        } catch (Exception $e) {
            DI()->notorm->rollback('db_demo');
            return false;
        }
    }

    public function edit($params)
    {
        $order_goods_model = new Model_OrderGoods();

        $order_goods = $order_goods_model->getById($this->goods_dbname, $params->id);
        if (!$order_goods || $order_goods['orderId'] != $params->orderId) {
            throw new PhalApi_Exception_BadRequest('产品不存在', 0);
        }

        $this->chkEditParams($params);
        $input = $this->getAddData($params);

        try {
            DI()->notorm->beginTransaction('db_demo');

            $id = $order_goods_model->edit($this->goods_dbname, $params->id, $input);
            if ($id === false) {
                throw new PhalApi_Exception_BadRequest('保存失败', 0);
            }
            $update_input = array(
                'updateUser' => DI()->userInfo['userId'],
                'updateTime' => date('Y-m-d H:i:s')
            );

            $oldSubTotalMoney = $order_goods['goodsPrice'] * $order_goods['goodsCnt'];
            $newSubTotalMoney = $input['goodsPrice'] * $input['goodsCnt'];

            if ($oldSubTotalMoney < $newSubTotalMoney) {
                $update_input['totalMoney'] = new NotORM_Literal('totalMoney+' . ($newSubTotalMoney - $oldSubTotalMoney));
            }
            if ($oldSubTotalMoney > $newSubTotalMoney) {
                $update_input['totalMoney'] = new NotORM_Literal('totalMoney-' . ($oldSubTotalMoney - $newSubTotalMoney));
            }
            if ($order_goods['goodsCnt'] < $input['goodsCnt']) {
                $update_input['totalCnt'] = new NotORM_Literal('totalCnt+' . ($input['goodsCnt'] - $order_goods['goodsCnt']));
            }
            if ($order_goods['goodsCnt'] > $input['goodsCnt']) {
                $update_input['totalCnt'] = new NotORM_Literal('totalCnt-' . ($order_goods['goodsCnt'] - $input['goodsCnt']));
            }

            if ($id && $this->type == 'PLAN' && $this->order['flag'] == 5) {
                $update_input['flag'] = 2;
            }

            $order_model = new Model_Order();
            $order_model->edit($this->dbname, $input['orderId'], $update_input);

            DI()->notorm->commit('db_demo');
            return $id;
        } catch (Exception $e) {
            DI()->notorm->rollback('db_demo');
            return false;
        }
    }

    public function delGoods($orderId, $id)
    {
        $order_model = new Model_Order();

        $order = $order_model->getById($this->dbname, $orderId);
        if (!$order || $order['createUser'] != DI()->userInfo['userId']) {
            throw new PhalApi_Exception_BadRequest('订单不存在', 0);
        }
        if ($this->type != 'PLAN' && !in_array($order['flag'], array(0, 1, 2, 3))) {
            throw new PhalApi_Exception_BadRequest('订单不能修改', 0);
        }
        if ($this->type == 'PLAN' && !in_array($order['flag'], array(0, 1))) {
            throw new PhalApi_Exception_BadRequest('订单不能修改', 0);
        }
        $goods_model = new Model_OrderGoods();

        $goods = $goods_model->getById($this->goods_dbname, $id);
        if (!$goods || $goods['orderId'] != $orderId) {
            throw new PhalApi_Exception_BadRequest('订单商品不存在', 0);
        }
        try {
            DI()->notorm->beginTransaction('db_demo');

            $id = $goods_model->del($this->goods_dbname, $orderId, $id);
            if ($id === false) {
                throw new PhalApi_Exception_BadRequest('保存失败', 0);
            }
            $subTotalMoney = $goods['goodsPrice'] * $goods['goodsCnt'];
            $update_input = array(
                'updateUser' => DI()->userInfo['userId'],
                'updateTime' => date('Y-m-d H:i:s'),
                'totalMoney' => new NotORM_Literal('totalMoney-' . $subTotalMoney),
                'totalCnt' => new NotORM_Literal('totalCnt-' . $goods['goodsCnt']),
            );

            $order_model->edit($this->dbname, $orderId, $update_input);

            DI()->notorm->commit('db_demo');
            return $id;
        } catch (Exception $e) {
            DI()->notorm->rollback('db_demo');
            return false;
        }
    }


    //保存订单
    public function save($param)
    {
        $order = $this->getOrderByStatus($param['orderId'], 0);
        if (!$order) {
            throw new PhalApi_Exception_BadRequest('订单不存在', 0);
        }
        if ($order['createUser'] != DI()->userInfo['userId']) {
            throw new PhalApi_Exception_BadRequest('没有权限', 3);
        }
        $user_model = new Model_User();
        $users = $user_model->getReviewers($this->reviewRole);
        if (!$users) {
            throw new PhalApi_Exception_BadRequest('请设置审核权限', 0);
        }
        $reviewers = array();
        foreach ($users as $u) {
            $reviewers[] = $u['user_id'];
        }
        if (!in_array($param['reviewer'], $reviewers)) {
            throw new PhalApi_Exception_BadRequest('审核人没有权限', 0);
        }

        $order_model = new Model_Order();

        return $order_model->edit($this->dbname, $param['orderId'], array(
            'reviewer' => $param['reviewer'],
            'flag' => 1,
            'updateUser' => DI()->userInfo['userId'],
            'updateTime' => date('Y-m-d H:i:s')
        ));
    }

    //订单列表
    public function getList($page_no, $page_size, $keyword, $status)
    {
        $model = new Model_Order();

        //总条数
        $row_count = $model->count($this->dbname, $keyword, $status);
        $total_page = $row_count % $page_size == 0 ? $row_count / $page_size : ceil($row_count / $page_size);
        $total_page = $total_page < 1 ? 1 : $total_page;
        $page_no = $page_no > ($total_page) ? ($total_page) : $page_no;
        $start = ($page_no - 1) * $page_size;

        $list = $model->getList($this->dbname, $start, $page_size, $keyword, $status);

        $rs = array(
            'row_count' => $row_count,
            'total_page' => $total_page,
            'page_no' => $page_no,
            'page_size' => $page_size,
            'list' => $list
        );

        return $rs;
    }

    //根据订单状态,id查询订单
    private function getOrderByStatus($orderId, $status)
    {
        $model = new Model_Order();

        return $model->getOrderByStatus($this->dbname, $orderId, $status);
    }

    //验证参数
    private function chkEditParams($params)
    {
        $order_model = new Model_Order();

        $order = $order_model->getById($this->dbname, $params->orderId);
        if (!$order || $order['createUser'] != DI()->userInfo['userId']) {
            throw new PhalApi_Exception_BadRequest('订单不存在', 0);
        }
        if ($this->type != 'PLAN' && !in_array($order['flag'], array(0, 1, 3))) {
            throw new PhalApi_Exception_BadRequest('订单不能修改', 0);
        }
        if ($this->type == 'PLAN' && !in_array($order['flag'], array(0, 1, 2, 3, 5))) {
            throw new PhalApi_Exception_BadRequest('订单不能修改', 0);
        }

        $this->order = $order;

        $supplier_domain = new Domain_Supplier_CURD();
        $supplier = $supplier_domain->getForOrder($params->supplierId);
        if (!$supplier) {
            throw new PhalApi_Exception_BadRequest('供应商不存在', 0);
        }

        //验证仓库
        if ($this->type == "PURCHASE_IN") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "ALLOT_IN") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->toDepotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "ALLOT_OUT") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->fromDepotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "USE_OUT") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "INVENTORY") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
    }

    public function getGoods($orderId, $goodsId)
    {
        $order_model = new Model_Order();
        $order = $order_model->getById($this->dbname, $orderId);
        if (!$order || $order['flag'] == -1 || $order['flag'] == -2) {
            throw new PhalApi_Exception_BadRequest('订单不存在', 0);
        }
        if ($order['createUser'] != DI()->userInfo['userId']) {
            throw new PhalApi_Exception_BadRequest('没有权限', 0);
        }

        $goods_model = new Model_OrderGoods();
        $goods = $goods_model->getById($this->goods_dbname, $goodsId);
        if (!$goods || $goods['orderId'] != $orderId) {
            throw new PhalApi_Exception_BadRequest('商品不存在', 0);
        }

        return $goods;
    }


    //验证登记商品参数
    private function chkAddParams($params)
    {
        $order = $this->getOrderByStatus($params->orderId, 0);
        if (!$order || $order['createUser'] != DI()->userInfo['userId']) {
            throw new PhalApi_Exception_BadRequest('订单不存在', 0);
        }
        $this->order = $order;

        $goods_domain = new Domain_Goods_CURD();
        $goods = $goods_domain->getForOrder($params->goodsId);
        if (!$goods) {
            throw new PhalApi_Exception_BadRequest('产品不存在', 0);
        }

        $supplier_domain = new Domain_Supplier_CURD();
        $supplier = $supplier_domain->getForOrder($params->supplierId);
        if (!$supplier) {
            throw new PhalApi_Exception_BadRequest('供应商不存在', 0);
        }

        //验证仓库
        if ($this->type == "PURCHASE_IN") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "ALLOT_IN") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->toDepotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "ALLOT_OUT") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->fromDepotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "USE_OUT") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }
        if ($this->type == "INVENTORY") {
            $depotSub_model = new Model_DepotSub();
            $depotSub = $depotSub_model->getForUD($params->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('库位不存在', 0);
            }
        }

        if ($params->goodsPrice <= 0) {
            throw new PhalApi_Exception_BadRequest('价格不能为0', 0);
        }
        if ($params->goodsCnt <= 0) {
            throw new PhalApi_Exception_BadRequest('数量不能为0', 0);
        }
    }

    private function getAddData($params)
    {
        $input = array();
        $role_params = DI()->config->get('app.orderInsertParam.' . $this->type);
        foreach ($role_params as $key => $value) {
            if ($params->{$key}) {
                $input[$key] = $params->{$key};
            }
        }

        return $input;
    }

    //获取表名
    private function getDB()
    {
        $dbname = array(
            'PLAN' => 'plan_orders',      //采购计划单
            'ARRIVAL' => 'arrival_orders',   //到货单
            'RETURN' => 'return_orders',    //退货单
            'PURCHASE_IN' => 'pstorage_orders',   //采购入库单
//            'OTHER_IN'      => 'IQ',   //其他入库单
            'ALLOT_IN' => 'astorage_orders',   //调拨入库单
            'ALLOT_OUT' => 'adeliver_orders',   //调拨出库单
            'USE_OUT' => 'udeliver_orders',   //领用出库单
//            'OTHER_OUT'     => 'OQ',   //其他出库单
            'INVENTORY' => 'count_orders'    //盘点单
        );
        return $dbname[$this->type];
    }

    //获取订单编号前缀
    private function getPrefix()
    {
        $prefix = array(
            'PLAN' => 'PR',   //采购计划单
            'ARRIVAL' => 'DH',   //到货单
            'RETURN' => 'TH',   //退货单
            'PURCHASE_IN' => 'IP',   //采购入库单
//            'OTHER_IN'      => 'IQ',   //其他入库单
            'ALLOT_IN' => 'ID',   //调拨入库单
            'ALLOT_OUT' => 'OD',   //调拨出库单
            'USE_OUT' => 'OY',   //领用出库单
//            'OTHER_OUT'     => 'OQ',   //其他出库单
            'INVENTORY' => 'PD'    //盘点单
        );
        return $prefix[$this->type];
    }

    //获取审核权限
    private function getReviewRole()
    {
        $role = array(
            'PLAN' => 193,   //采购计划单
            'ARRIVAL' => 194,   //到货单
            'RETURN' => 195,   //退货单
            'PURCHASE_IN' => 196,   //采购入库单
//            'OTHER_IN'      => 197,   //其他入库单
            'ALLOT_IN' => 198,   //调拨入库单
            'ALLOT_OUT' => 201,   //调拨出库单
            'USE_OUT' => 199,   //领用出库单
//            'OTHER_OUT'     => 200,   //其他出库单
            'INVENTORY' => 202    //盘点单
        );
        return $role[$this->type];
    }


}
<?php

/**
 * 订单商品类
 * Class Domain_Order_Goods
 */
class Domain_Order_Goods
{
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        if (!isset($this->$name) || empty($name)) {
            return null;
        }
        return $this->$name;
    }


    public function chk($action = 'add')
    {
        if ($action == 'add' && $this->type != 'INVENTORY' && $this->goodsCnt < 1) {
            throw new PhalApi_Exception_BadRequest('数量不能为0', 1);
        }

        if (isset($this->arrivalTime)) {
            $unixTime = strtotime($this->arrivalTime);
            if (!$unixTime) {
                throw new PhalApi_Exception_BadRequest('日期格式不正确', 1);
            }

            $today = strtotime(date('Y-m-d'));

            if ($unixTime < $today) {
                throw new PhalApi_Exception_BadRequest('日期不能小于当前日期', 1);
            }
        }

        if (isset($this->orderId)) {
            $model = new Model_Order();

            $order = $model->get($this->orderId);
            if (!$order) {
                throw new PhalApi_Exception_BadRequest('订单不存在', 1);
            }

            if (!in_array($order['flag'], array(0, 1, -3))) {
                throw new PhalApi_Exception_BadRequest('订单不能修改', 1);
            }

            if (DI()->userInfo['userId'] != $order['createUser']) {
                throw new PhalApi_Exception_BadRequest('没有权限', 1);
            }

            $this->order = $order;
        }

        if ($action == 'add' && isset($this->goodsId)) {
            $model = new Model_Goods();
            $goods = $model->getForOrder($this->goodsId);
            if (!$goods) {
                throw new PhalApi_Exception_BadRequest('产品不存在', 1);
            }

            if ($this->type != 'ALLOT_IN') {
                //重新赋值
                $this->supplierId = $this->order['supplierId'];
            }

            //判断重复
            $order_goods_model = new Model_OrderGoods();

            $depotSubId = 0;
            if ($this->type == 'PURCHASE_IN' || $this->type == 'ALLOT_IN') {
                $depotSubId = $this->depotSubId;
            }

            $repeat_goods = $order_goods_model->getRepeat($this->orderId, $this->goodsId, $this->supplierId,
                $depotSubId);
            if ($repeat_goods) {
                throw new PhalApi_Exception_BadRequest('存在相同供应商和库位的登记产品', 1);
            }

            $this->goods = $goods;
        }

        if ($action == 'add' && isset($this->id)) {
            $model = new Model_DepotGoods();

            $goods = $model->get($this->id);

            if (!$goods) {
                throw new PhalApi_Exception_BadRequest('库存商品不存在', 1);
            }

            if ($goods['flag'] != 1) {
                throw new PhalApi_Exception_BadRequest('商品库存为0', 1);
            }

            if ($goods['goodsCnt'] < $this->goodsCnt && $this->type != 'INVENTORY') {
                throw new PhalApi_Exception_BadRequest('商品库存不足,库存:' . $goods['goodsCnt'], 1);
            }

            //判断重复
            $order_goods_model = new Model_OrderGoods();
            $repeat_goods = $order_goods_model->getRepeatV2($this->orderId, $this->id);
            if ($repeat_goods) {
                throw new PhalApi_Exception_BadRequest('存在重复产品', 1);
            }

            $this->goods = $goods;

            //重新赋值
            if($this->type!='SALE_OUT'){
                $this->goodsPrice = $goods['goodsPrice'];
            }
            $this->goodsId = $goods['goodsId'];
            $this->supplierId = $goods['supplierId'];
            $this->depotSubId = $goods['depotSubId'];
            if($this->type == 'SALE_OUT'){
                $this->depotId = $goods['depotId'];
            }
        }

        if ($action == 'edit' && isset($this->id)) {
            $goods_model = new Model_OrderGoods();

            $goods = $goods_model->getById($this->orderId, $this->id);

            if (!$goods) {
                throw new PhalApi_Exception_BadRequest('订单商品不存在', 1);
            }

            if ($this->type == 'ALLOT_OUT' || $this->type == 'USE_OUT' || $this->type == 'INVENTORY' || $this->type=='SALE_OUT') {
                //出库验证商品库存
                $depot_goods_model = new Model_DepotGoods();

                $depot_goods = $depot_goods_model->get($goods[0]['depotGoodsId']);
                if (!$depot_goods) {
                    throw new PhalApi_Exception_BadRequest('库存商品不存在', 1);
                }

                if ($depot_goods['flag'] != 1) {
                    throw new PhalApi_Exception_BadRequest('商品库存为0', 1);
                }

                if ($depot_goods['goodsCnt'] < $this->goodsCnt && $this->type != 'INVENTORY') {
                    throw new PhalApi_Exception_BadRequest('商品库存不足,库存:' . $depot_goods['goodsCnt'], 1);
                }
            }
            if ($this->type == 'ALLOT_IN' && ($goods[0]['supplierId'] != $this->supplierId || $goods[0]['depotSubId'] != $this->depotSubId)) {
                //入库单单判断重复
                $repeat_goods = $goods_model->getRepeat($this->orderId, $goods[0]['goodsId'], $this->supplierId,
                    $this->depotSubId);
                if ($repeat_goods) {
                    throw new PhalApi_Exception_BadRequest('存在相同供应商和库位的登记产品', 1);
                }
            }
            if ($this->type == 'PURCHASE_IN' && $goods[0]['depotSubId'] != $this->depotSubId) {
                //判断重复
                $repeat_goods = $goods_model->getRepeat($this->orderId, $goods[0]['goodsId'], $goods[0]['supplierId'],
                    $this->depotSubId);
                if ($repeat_goods) {
                    throw new PhalApi_Exception_BadRequest('存在相同库位的登记产品', 1);
                }
            }

            $this->goods = $goods[0];
        }


        if ($this->type == 'ALLOT_IN' && isset($this->supplierId)) {
            $model = new Model_Supplier();
            $supplier = $model->getForOrder($this->supplierId);
            if (!$supplier) {
                throw new PhalApi_Exception_BadRequest('供应商不存在', 1);
            }

            $this->supplier = $supplier;
        }

        if (isset($this->depotSubId)) {
            $domain = new Domain_DepotSub_CURD();
            $depotSub = $domain->getForUD($this->depotSubId);
            if (!$depotSub) {
                throw new PhalApi_Exception_BadRequest('公司库位不存在', 1);
            }
        }

        if (isset($this->departmentId)) {
            $model = new Model_Department();
            $department = $model->get($this->departmentId);
            if (!$department) {
                throw new PhalApi_Exception_BadRequest('部门不存在', 1);
            }

            $this->department = $department;
        }

        if (isset($this->employeeId)) {
            if (!$this->departmentId) {
                throw new PhalApi_Exception_BadRequest('缺少参数 departmentId', 1);
            }

            $model = new Model_Employee();
            $employee = $model->getForUD($this->employeeId);
            if (!$employee) {
                throw new PhalApi_Exception_BadRequest('公司员工不存在', 1);
            }

            $this->employee = $employee;
        }
    }


    public function get($orderId, $id)
    {
        $model = new Model_OrderGoods();

        $goods = $model->getById($orderId, $id);
        if ($goods && ($this->type == 'ALLOT_OUT' || $this->type == 'USE_OUT' || $this->type == 'INVENTORY')) {

            $model = new Model_Supplier();
            $supplier = $model->getForOrder($goods[0]['supplierId']);

            $goods[0]['supplierName'] = $supplier ? $supplier['supplierName'] : '';

            $model = new Model_DepotSub();
            $depotSub = $model->fetch($goods[0]['depotSubId']);
            $goods[0]['depotSubName'] = '';
            if ($depotSub && $depotSub['flag'] == 1) {
                $goods[0]['depotSubName'] = $depotSub['depotSubName'];
            }
        }

        return $goods;
    }


    public function insert($input)
    {
        $this->chk('add');

        $model = new Model_OrderGoods();

        //重新赋值
        $input['goodsPrice'] = $this->goodsPrice;
        $input['supplierId'] = $this->supplierId;

        $input['flag'] = 1;
        $input['createCompany'] = DI()->userInfo['companyId'];
        $input['createUser'] = DI()->userInfo['userId'];
        $input['createTime'] = date('Y-m-d H:i:s');
        if(in_array($this->type,array('ALLOT_IN','USE_OUT','INVENTORY','ALLOT_OUT'))){
            $input['depotId'] = $this->order['depotId'];
        }

        if (isset($input['id'])) {
            //出库单商品 重新赋值
            $input['goodsId'] = $this->goodsId;
            $input['depotGoodsId'] = $this->id;
            $input['depotSubId'] = $this->depotSubId;
            $input['orderSubNo'] = $this->goods['batchNo'];
            if($this->type=='SALE_OUT'){
                $input['depotId'] = $this->depotId;
            }
            unset($input['supplierId']);
            unset($input['id']);
        }

        $input['orderFlag'] = $this->order['flag'];

        if ($this->type == 'PURCHASE_IN' || $this->type == 'ALLOT_IN') {
            //入库单商品批次号
            $prefix = $this->type == 'PURCHASE_IN' ? 'PN' : 'AN';
            $input['orderSubNo'] = $prefix . date('ymdHis') . rand(1000, 9999);
        }

        return $model->insert($input);
    }

    public function update($input)
    {
        $this->chk('edit');

        if ($this->type == 'ALLOT_OUT' || $this->type == 'USE_OUT' || $this->type == 'INVENTORY') {
            //出库单重新赋值
            $input['goodsPrice'] = $this->goods['goodsPrice'];
        }
        unset($input['id']);
        $input['orderFlag'] = $this->order['flag'];

        $order_goods_model = new Model_OrderGoods();


        if ($input['goodsCnt'] < 1) {
            $input['totalMoney'] = new NotORM_Literal('totalMoney-' . ($this->goods['goodsPrice'] * $this->goods['goodsCnt']));
            $input['totalCnt'] = new NotORM_Literal('totalCnt-' . $this->goods['goodsCnt']);

            return $order_goods_model->delete($this->id, $input);
        } else {
            $old_subTotalMoney = $this->goods['goodsPrice'] * $this->goods['goodsCnt'];
            $old_subTotalCnt = $this->goods['goodsCnt'];
            $subTotalMoney = $input['goodsPrice'] * $input['goodsCnt'];
            $subTotalCnt = $input['goodsCnt'];


            $input['totalMoney'] = new NotORM_Literal('totalMoney+' . ($subTotalMoney - $old_subTotalMoney));
            $input['totalCnt'] = new NotORM_Literal('totalCnt+' . ($subTotalCnt - $old_subTotalCnt));

            return $order_goods_model->update($this->id, $input);
        }
    }

    public function delete($orderId, $id)
    {
        $model = new Model_Order();

        $order = $model->get($orderId);
        if (!$order || !in_array($order['flag'], array(0, 1, -3))) {
            throw new PhalApi_Exception_BadRequest('订单不能修改', 1);
        }
        if (DI()->userInfo['userId'] != $order['createUser']) {
            throw new PhalApi_Exception_BadRequest('没有权限', 1);
        }

        if (empty($id)) {
            throw new PhalApi_Exception_BadRequest('订单商品不存在', 1);
        }

        $flag = 0;
        $totalMoney = 0;
        $totalCnt = 0;
        foreach ($id as $g) {
            $goods = $this->get($orderId, $g);
            if (!$goods) {
                $flag = 1;
                break;
            }
            $totalMoney += $goods[0]['goodsPrice'] * $goods[0]['goodsCnt'];
            $totalCnt += $goods[0]['goodsCnt'];
        }

        if ($flag == 1) {
            throw new PhalApi_Exception_BadRequest('订单商品不存在', 1);
        }

        $goods_model = new Model_OrderGoods();

        $input['totalMoney'] = new NotORM_Literal('totalMoney-' . $totalMoney);
        $input['totalCnt'] = new NotORM_Literal('totalCnt-' . $totalCnt);
        $input['orderId'] = $orderId;
        $input['orderFlag'] = $order['flag'];

        return $goods_model->delete($id, $input);
    }
}
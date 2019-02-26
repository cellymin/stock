<?php

class Model_OrderGoods extends PhalApi_Model_NotORM
{
    public function getTableKey($table)
    {
        return 'id'; // TODO: Change the autogenerated stub
    }

    public function getTableName($id)
    {
        $tableName = array(
            'PLAN'        => 'orders_pr_goods',
            'ARRIVAL'     => 'orders_dh_goods',
            'RETURN'      => 'orders_th_goods',
            'PURCHASE_IN' => 'orders_ip_goods',
            'OTHER_IN'    => 'orders_iq_goods',
            'ALLOT_IN'    => 'orders_id_goods',
            'ALLOT_OUT'   => 'orders_od_goods',
            'USE_OUT'     => 'orders_oy_goods',
            'OTHER_OUT'   => 'orders_oq_goods',
            'INVENTORY'   => 'orders_pd_goods',
            'SALE_OUT'    => 'orders_so_goods',
            'SALE_RETURN' => 'orders_soth_goods',
            'USE_RETURN' => 'orders_oyth_goods'
        );
        return $tableName[DI()->request->get('type')]; // TODO: Change the autogenerated stub
    }

    public function getList($orderId, $start, $page_size)
    {
        // 采购|进货|退货   unitName supplierName goodsName
        // 采购入库单|调拨入库单   unitName supplierName goodsName depotSubName
        // 调拨出库单|领用出库单   employeeName departmentName goodsName
        // 盘点单  goodsName
        // 销售单  customerName
        $type = DI()->request->get('type');

        $columns = 'og.*,g.goodsName,g.goodsSpec,';
        $left_join = 'left join vich_goods g on g.goodsId=og.goodsId ';

        if($type=='SALE_OUT'||$type=='SALE_RETURN'){

        }else{
            $columns .= 's.supplierName,s.taxrate,';
            $left_join .= 'left join vich_suppliers s on s.supplierId=og.supplierId ';
        }


        if (in_array($type, array('PLAN', 'RETURN', 'ARRIVAL', 'PURCHASE_IN', 'ALLOT_IN'))) {
            $columns .= 'u.unitName,';
            $left_join .= 'left join vich_goods_units u on u.unitId=g.goodsUnitId ';
        }

        if (in_array($type,
            array('PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY', 'OTHER_IN', 'OTHER_OUT','SALE_OUT','SALE_RETURN','USE_RETURN'))) {
            $columns .= 'd.depotSubName,';
            $left_join .= 'left join vich_depot_subs d on d.depotSubId=og.depotSubId ';
        }

        if ($type == 'INVENTORY') {
            $columns .= 'dg.goodsCnt as depotGoodsCnt,';
            $left_join .= 'left join vich_depot_goods dg on dg.id=og.depotGoodsId ';
        }

        if ($type == 'PURCHASE_IN' || $type=='SALE_OUT'||$type=='SALE_RETURN') {
            $columns .= 'dd.depotName,';
            $left_join .= 'left join vich_depots dd on dd.depotId=og.depotId ';
        }

        if (in_array($type, array('ALLOT_OUT', 'USE_OUT','USE_RETURN'))) {
            $columns .= 'de.departmentName,e.employeeName,';

            $left_join .= 'left join vich_departments de on de.departmentId=og.departmentId '
                . 'left join vich_employees e on e.employeeId=og.employeeId ';
        }

        $sql = 'select ' . rtrim($columns, ',')
            . ' from vich_' . $this->getTableName('*') . ' og ' . $left_join . ' where og.orderId=? and og.flag=1';

        $param[] = $orderId;

        if ($page_size) {
            $sql .= " limit $start,$page_size";
        }

        return $this->getORM()->queryAll($sql, $param);
    }

    public function count($orderId)
    {
        return $this->getORM()
            ->select('*')
            ->where('orderId=? and flag=1', $orderId)
            ->count();
    }

    public function getRepeat($orderId, $goodsId, $supplierId, $depotSubId = 0)
    {
        $where = 'orderId=? and goodsId=? and supplierId=? and flag=1';
        $param = array($orderId, $goodsId, $supplierId);

        if ($depotSubId != 0) {
            $where .= ' and depotSubId=?';
            $param[] = $depotSubId;
        }

        return $this->getORM()
            ->select('*')
            ->where($where, $param)
            ->fetch();
    }

    public function getRepeatV2($orderId, $goodsId)
    {
        return $this->getORM()
            ->select('*')
            ->where('orderId=? and depotGoodsId=? and flag=1', array($orderId, $goodsId))
            ->fetch();
    }

    public function insert($data, $id = null)
    {
        $orderFlag = $data['orderFlag'];
        unset($data['orderFlag']);

        try {
            DI()->notorm->beginTransaction('db_demo');
            $id = parent::insert($data, $id); // TODO: Change the autogenerated stub
            if (!$id) {
                throw new PDOException('保存失败', 1);
            }

            $order_input = array(
                'totalMoney' => new NotORM_Literal('totalMoney+' . $data['goodsPrice'] * $data['goodsCnt']),
                'totalCnt'   => new NotORM_Literal('totalCnt+' . $data['goodsCnt']),
                'updateTime' => date('Y-m-d H:i:s'),
                'updateUser' => DI()->userInfo['userId'],
            );
            if ($orderFlag == 1) {
                $order_input['flag'] = 0;
            }

            $order_model = new Model_Order();
            $num = $order_model->update($data['orderId'], $order_input);
            if ($num === false) {
                throw new PDOException('订单更新失败', 1);
            }

            $log_model = new Model_LogOrder();
            $logId = $log_model->insert(array(
                'logUser'    => DI()->userInfo['userId'],
                'logType'    => 'INSERT',
                'logContent' => json_encode($data),
                'orderId'    => $data['orderId'],
                'orderType'  => DI()->request->get('type'),
                'createTime' => date('Y-m-d H:i:s')
            ));
            if (!$logId) {
                throw new PDOException('订单日志错误', 1);
            }

            DI()->notorm->commit('db_demo');
            return $id;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_InternalServerError($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('异常', 0);
        }
    }

    public function update($id, $data)
    {
        try {
            DI()->notorm->beginTransaction('db_demo');

            $totalMoney = $data['totalMoney'];
            $totalCnt = $data['totalCnt'];
            $orderId = $data['orderId'];
            $orderFlag = $data['orderFlag'];

            unset($data['totalMoney']);
            unset($data['totalCnt']);
            unset($data['orderId']);
            unset($data['orderFlag']);

            $num = parent::update($id, $data); // TODO: Change the autogenerated stub
            if ($num === false) {
                throw new PDOException('保存失败', 1);
            }

            $order_input = array(
                'totalMoney' => $totalMoney,
                'totalCnt'   => $totalCnt,
                'updateTime' => date('Y-m-d H:i:s'),
                'updateUser' => DI()->userInfo['userId'],
            );
            if ($orderFlag == 1) {
                $order_input['flag'] = 0;
            }

            $order_model = new Model_Order();
            $num = $order_model->update($orderId, $order_input);
            if ($num === false) {
                throw new PDOException('订单更新失败', 1);
            }

            $data['id'] = $id;

            $log_model = new Model_LogOrder();
            $logId = $log_model->insert(array(
                'logUser'    => DI()->userInfo['userId'],
                'logType'    => 'UPDATE',
                'logContent' => json_encode($data),
                'orderId'    => $orderId,
                'orderType'  => DI()->request->get('type'),
                'createTime' => date('Y-m-d H:i:s')
            ));
            if (!$logId) {
                throw new PDOException('订单日志错误', 1);
            }

            DI()->notorm->commit('db_demo');
            return $num;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_InternalServerError($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('异常', 0);
        }
    }

    public function delete($id, $data = null)
    {
        try {
            DI()->notorm->beginTransaction('db_demo');

            $totalMoney = $data['totalMoney'];
            $totalCnt = $data['totalCnt'];
            $orderId = $data['orderId'];
            $orderFlag = $data['orderFlag'];

            unset($data['totalMoney']);
            unset($data['totalCnt']);
            unset($data['orderId']);
            unset($data['orderFlag']);

            $num = parent::update($id, array('flag' => -1)); // TODO: Change the autogenerated stub
            if ($num === false) {
                throw new PDOException('删除失败', 1);
            }

            $order_input = array(
                'totalMoney' => $totalMoney,
                'totalCnt'   => $totalCnt,
                'updateTime' => date('Y-m-d H:i:s'),
                'updateUser' => DI()->userInfo['userId'],
            );

            if ($orderFlag == 1) {
                $order_input['flag'] = 0;
            }

            $order_model = new Model_Order();
            $num = $order_model->update($orderId, $order_input);
            if ($num === false) {
                throw new PDOException('订单更新失败', 1);
            }

            $log_model = new Model_LogOrder();
            $logId = $log_model->insert(array(
                'logUser'    => DI()->userInfo['userId'],
                'logType'    => 'DELETE',
                'logContent' => json_encode(array('flag' => -1, 'id' => $id)),
                'orderId'    => $orderId,
                'orderType'  => DI()->request->get('type'),
                'createTime' => date('Y-m-d H:i:s')
            ));
            if (!$logId) {
                throw new PDOException('订单日志错误', 1);
            }

            DI()->notorm->commit('db_demo');
            return $num;
        } catch (PDOException $e) {
            DI()->notorm->rollback('db_demo');
            if ($e->getCode() == 1) {
                throw new PhalApi_Exception_InternalServerError($e->getMessage(), 0);
            }
            throw new PhalApi_Exception_InternalServerError('异常', 0);
        }
    }

    public function getById($orderId, $id)
    {
        $sql = 'select og.*,g.goodsName '
            . 'from vich_' . $this->getTableName('*') . ' og '
            . 'left join vich_goods g on g.goodsId=og.goodsId '
            . 'where og.orderId=:orderId and og.id=:id and og.flag=1';
        $param = array(
            ':orderId' => $orderId,
            ':id'      => $id,
        );

        if (DI()->userInfo['userGroup'] != 1) {
            $sql .= ' and og.createUser=:userId ';
            $param[':userId'] = DI()->userInfo['userId'];
        }

        return $this->getORM()
            ->queryAll($sql, $param);
    }

    public function getAll($orderId)
    {
        return $this->getORM()
            ->select('*')
            ->where('orderId=? and flag=1', $orderId)
            ->fetchAll();
    }

    //多条插入
    public function insert_multi($type, $data)
    {
        $table = $type == 'OTHER_IN' ? 'orders_iq_goods' : 'orders_oq_goods';

        return DI()->notorm->$table->insert_multi($data);
    }
}
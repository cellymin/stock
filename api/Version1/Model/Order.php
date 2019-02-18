<?php

class Model_Order extends PhalApi_Model_NotORM
{
    public function getTableKey($table)
    {
        return 'orderId'; // TODO: Change the autogenerated stub
    }

    public function getTableName($id)
    {
        $tableName = array(
            'PLAN' => 'orders_pr',
            'ARRIVAL' => 'orders_dh',
            'RETURN' => 'orders_th',
            'PURCHASE_IN' => 'orders_ip',
            'OTHER_IN' => 'orders_iq',
            'ALLOT_IN' => 'orders_id',
            'ALLOT_OUT' => 'orders_od',
            'USE_OUT' => 'orders_oy',
            'OTHER_OUT' => 'orders_oq',
            'INVENTORY' => 'orders_pd',
            'SALE_OUT' => 'orders_so',
            'SALE_RETURN' => 'orders_soth'
        );

        return $tableName[DI()->request->get('type')]; // TODO: Change the autogenerated stub
    }

    public function getStatus($status)
    {
        $arr = array(1 => 0, 2 => 1, 3 => -3, 4 => 3);

        return $arr[$status];
    }

    public function getById($orderId)
    {
        $type = DI()->request->get('type');
        $columns = '';
        $join = '';
        if (in_array($type, array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN'))) {
            $columns = 's.supplierName,s.taxrate';
            $join = ' left join vich_suppliers s on s.supplierId=o.supplierId ';
        }
        if (in_array($type, array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY', 'OTHER_IN', 'OTHER_OUT'))) {
            $columns = 'd.depotName';
            $join = ' left join vich_depots d on d.depotId=o.depotId ';
        }
        if ($type == 'SALE_OUT') {
            $columns = 'c.customerName';
            $join = ' left join vich_customers c on c.customerId=o.customerId ';
        }
        if ($type == 'SALE_RETURN'){
            $columns = 'c.customerName';
            $join = ' left join vich_customers c on c.customerId=o.customerId ';
        }

        $sql = 'select o.*,u.real_name,u.user_name,'.$columns.', '
            .'(case o.flag when 0 then "未提交" when 1 then "待审核" when -3 then "驳回" when 3 then "审核通过" end) as status '
            .'from vich_'.$this->getTableName('*').' o '
            .'left join vich_user u on u.user_id=o.createUser '
            .$join
            .'where o.orderId=:orderId ';
        $param[':orderId'] = $orderId;

        if (DI()->userInfo['userGroup'] != 1) {
            if (DI()->userInfo['selectAll'] == 1) {
                $sql .= ' and o.createCompany=:companyId';
                $param[':companyId'] = DI()->userInfo['companyId'];
            } else {
                $sql .= ' and o.createUser=:userId';
                $param[':userId'] = DI()->userInfo['userId'];
            }
        }

        return $this->getORM()->queryAll($sql, $param);
    }


    public function count($keyword, $status)
    {
        $where = 'orderNo like ?';
        $param[] = "%$keyword%";

        if ($status) {
            $where .= ' and flag=?';
            $param[] = $this->getStatus($status);
        }
        $where .= ' and flag<>-1 ';

        if (DI()->userInfo['userGroup'] != 1) {
            if (DI()->userInfo['selectAll'] == 1) {
                $where .= ' and createCompany=?';
                $param[] = DI()->userInfo['companyId'];
            } else {
                $where .= ' and createUser=?';
                $param[] = DI()->userInfo['userId'];
            }
        }

        $notorm = $this->getORM();

        return $notorm->select('*')
            ->where($where, $param)
            ->count();
    }

    public function getList($start, $page_size, $keyword, $status)
    {
        $limit = "";
        if ($page_size) {
            $limit = " limit $start,$page_size";
        }

        $join = '';
        $columns = '';

        if (in_array(DI()->request->get('type'), array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN'))) {
            $join = 'left join vich_suppliers s on s.supplierId=o.supplierId ';
            $columns = 's.supplierName,';
        }
        if (in_array(
            DI()->request->get('type'),
            array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY', 'OTHER_IN', 'OTHER_OUT')
        )) {
            $join = 'left join vich_depots d on d.depotId=o.depotId ';
            $columns = 'd.depotName,';
        }
        if (DI()->request->get('type') == 'SALE_OUT') {
            $join = 'left join vich_customers c on c.customerId=o.customerId ';
            $columns = 'c.customerName,';
        }
        if (DI()->request->get('type') == 'SALE_RETURN') {
            $join = 'left join vich_customers c on c.customerId=o.customerId ';
            $columns = 'c.customerName,';
        }
        $sql = 'select o.*,u.real_name,u.user_name,'.$columns
            .'(case o.flag when 0 then "未提交" when 1 then "待审核" when -3 then "驳回" when 3 then "审核通过" end) as status '
            .'from vich_'.$this->getTableName('*').' o '
            .'left join vich_user u on u.user_id=o.createUser '
            .$join
            .'where o.flag<>-1 and o.orderNo like :keyword ';
        $param[':keyword'] = "%$keyword%";
        if ($status) {
            $sql .= ' and o.flag=:status ';
            $param[':status'] = $this->getStatus($status);;
        }

        if (DI()->userInfo['userGroup'] != 1) {
            if (DI()->userInfo['selectAll'] == 1) {
                $sql .= ' and o.createCompany=:companyId';
                $param[':companyId'] = DI()->userInfo['companyId'];
            } else {
                $sql .= ' and o.createUser=:userId';
                $param[':userId'] = DI()->userInfo['userId'];
            }
        }

        $sql .= ' order by o.createTime desc ';

        $sql .= $limit;

        return $this->getORM()->queryAll($sql, $param);
    }


    public function delete($id)
    {
        $num = parent::update($id, array('flag' => -1));
        $log_model = new Model_LogOrder();
        $log_model->insert(
            array(
                'logUser' => DI()->userInfo['userId'],
                'logType' => 'DELETE',
                'logContent' => json_encode(array('flag' => -1, 'id' => $id)),
                'orderId' => 0,
                'orderType' => DI()->request->get('type'),
                'createTime' => date('Y-m-d H:i:s'),
            )
        );

        return $num;
    }

    public function addOther($type, $input)
    {
        $table = $type == 'OTHER_IN' ? 'orders_iq' : 'orders_oq';

        DI()->notorm->$table->insert($input);

        return DI()->notorm->$table->insert_id();
    }

    public function updateOther($type, $orderId, $input)
    {
        $table = $type == 'OTHER_IN' ? 'orders_iq' : 'orders_oq';

        return DI()->notorm->$table->where('orderId=?', $orderId)->update($input);
    }

    public static function getNeedSendDeliverMsg($companyId)
    {
        $time = date('Y-m-d H:i:s');

        return DI()->notorm->orders_so
            ->select('*')
            ->where(
                'flag=1 and noticeTime is not null and noticeTime<=? and createCompany=?',
                array($time, $companyId)
            )
            ->fetchAll();
    }

    public function create($data)
    {
        $param = array(
            'orderNo' => $data['orderNo'],
            'totalMoney' => $data['totalMoney'],
            'totalCnt' => $data['totalCnt'],
            'flag' => $data['flag'],
            'depotId' => $data['depotId'],
            'createCompany' => $data['createCompany'],
            'createUser' => $data['createUser'],
            'createTime' => $data['createTime'],
            'from'=>$data['from']
        );
        $res = DI()->notorm->orders_oy->insert($param);

        return $res;
    }
}
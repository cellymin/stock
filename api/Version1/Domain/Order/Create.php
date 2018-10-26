<?php

class Domain_Order_Create
{

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function create($data)
    {
        $input = array();

        if (in_array($this->type, array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN'))) {
            $model = new Model_Supplier();
            $supplier = $model->getForOrder($data['supplierId']);
            if (!$supplier) {
                throw new PhalApi_Exception_BadRequest('供应商不存在', 0);
            }
            $input['supplierId'] = $data['supplierId'];
        }
        if (in_array($this->type, array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY'))) {
            $model = new Model_Depot();
            $supplier = $model->getById($data['depotId']);
            if (!$supplier) {
                throw new PhalApi_Exception_BadRequest('仓库不存在', 0);
            }
            $input['depotId'] = $data['depotId'];
        }
        if ($this->type == 'SALE_OUT') {
            $model = new Model_Customer();
            $customer = $model->get($data['customerId']);
            if (!$customer) {
                throw new PhalApi_Exception_BadRequest('客户不存在', 0);
            }
            $input['deliverTime'] = $data['deliverTime'];
            $input['customerId'] = $data['customerId'];
        }

        $input['orderNo'] = $this->getOrderPrefix() . date('ymdHis') . rand(1000, 9999);
        $input['totalMoney'] = 0;
        $input['totalCnt'] = 0;
        $input['flag'] = 0;
        $input['createCompany'] = DI()->userInfo['companyId'];
        $input['createUser'] = DI()->userInfo['userId'];
        $input['remark'] = $data['remark'];
        $input['createTime'] = date('Y-m-d H:i:s');

        $model = new Model_Order();
//        error_log(print_r($input,1));
        $orderId = $model->insert($input);
        if ($orderId) {
            $log_model = new Model_LogOrder();
            $log_model->insert(array(
                'logUser'    => DI()->userInfo['userId'],
                'logType'    => 'CREATE',
                'logContent' => json_encode($input),
                'orderId'    => $orderId,
                'orderType'  => $this->type,
                'createTime' => date('Y-m-d H:i:s')
            ));
        }

        return $orderId;
    }

    private function getOrderPrefix()
    {
        $prefix = array(
            'PLAN'        => 'PR',   //采购计划单
            'ARRIVAL'     => 'DH',   //到货单
            'RETURN'      => 'TH',   //退货单
            'PURCHASE_IN' => 'IP',   //采购入库单
            'OTHER_IN'    => 'IQ',   //其他入库单
            'ALLOT_IN'    => 'ID',   //调拨入库单
            'ALLOT_OUT'   => 'OD',   //调拨出库单
            'USE_OUT'     => 'OY',   //领用出库单
            'OTHER_OUT'   => 'OQ',   //其他出库单
            'INVENTORY'   => 'PD',    //盘点单
            'SALE_OUT'    => 'SO'    //销售单
        );
        return $prefix[$this->type];
    }
}
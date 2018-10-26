<?php

class Api_Order_Create extends PhalApi_Api
{
    public function getRules()
    {
        $type = DI()->request->get('type');
        if (!$type) {
            throw new PhalApi_Exception_BadRequest('缺少必要参数 type', 0);
        }

        $range = array('PLAN', 'ARRIVAL', 'RETURN', 'ALLOT_IN','PURCHASE_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT');
        if (!in_array($type, $range)) {
            throw new PhalApi_Exception_BadRequest('type 应为 ' . implode('/', $range) . '中的一个', 0);
        }

        if (in_array($type, array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN'))) {
            return array(
                'go' => array(
                    'supplierId' => array('name' => 'supplierId', 'type' => 'int', 'min' => 1, 'require' => true),
                    'remark'=>array('name' => 'remark', 'type' => 'string', 'require' => false),
                )
            );
        }
        if($type=='SALE_OUT'){
            return array(
                'go' => array(
                    'customerId' => array('name' => 'customerId', 'type' => 'int', 'min' => 1, 'require' => true),
                    'deliverTime'=>array('name' => 'deliverTime', 'type' => 'date',  'require' => true),
                    'remark'=>array('name' => 'remark', 'type' => 'string', 'require' => false),
                )
            );
        }
        return array(
            'go' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int', 'min' => 1, 'require' => true),
                'remark'=>array('name' => 'remark', 'type' => 'string', 'require' => false),
            )
        );
    }


    public function go()
    {
        $rs = array('code' => 0, 'orderId' => '', 'msg' => '');
        $type = DI()->request->get('type');

        $domain = new Domain_Order_Create();

        $domain->type = $type;

        $input = array();

        if (in_array($type, array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN'))) {
            $input['supplierId'] = $this->supplierId;
        }
        if (in_array($type, array('ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY'))) {
            $input['depotId'] = $this->depotId;
        }
        if ($type == 'SALE_OUT') {
            $input['customerId'] = $this->customerId;
            $input['deliverTime'] = $this->deliverTime;
        }

        $input['remark'] = $this->remark;

        $orderId = $domain->create($input);
        if ($orderId == false) {
            $rs['msg'] = '创建失败';
            return $rs;
        }

        $rs['code'] = 1;
        $rs['orderId'] = $orderId;

        return $rs;
    }
}
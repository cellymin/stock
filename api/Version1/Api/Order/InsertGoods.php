<?php

class Api_Order_InsertGoods extends PhalApi_Api
{
    private $rules;
    private $type;

    public function getRules()
    {
        // 公共参数 type,orderId,goodsCnt,remark

        //采购单 goodsId goodsPrice arrivalTime

        //进货单 退货单 goodsId goodsPrice

        //调拨入库单 goodsId goodsPrice supplierId depotSubId

        //采购入库单 goodsId goodsPrice depotId depotSubId

        //调拨出库单 领用出库单 [ 库存商品id,departmentId,employeeId ]

        //盘点单 [库存商品id]

        $type = DI()->request->get('type');
        if (!$type) {
            throw new PhalApi_Exception_BadRequest('缺少必要参数 type', 0);
        }

        $range = array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT');
        if (!in_array($type, $range)) {
            throw new PhalApi_Exception_BadRequest('type 应为 ' . implode('/', $range) . '中的一个', 0);
        }

        $common_rules = array(
            'orderId'    => array('name' => 'orderId', 'type' => 'int', 'min' => 0, 'require' => true),
            'goodsId'    => array('name' => 'goodsId', 'type' => 'int', 'min' => 0, 'require' => true),
            'goodsPrice' => array('name' => 'goodsPrice', 'type' => 'float', 'min' => 0, 'require' => true),
            'goodsCnt'   => array('name' => 'goodsCnt', 'type' => 'int', 'min' => 0, 'require' => true),
            'remark'     => array('name' => 'remark', 'type' => 'string', 'require' => false),
        );

        $type_rules = array(
            'PLAN'        => array(
                'arrivalTime' => array('name' => 'arrivalTime', 'type' => 'date', 'require' => true),
            ),
            'PURCHASE_IN' => array(
                'depotId' => array('name' => 'depotId', 'type' => 'int', 'min' => 0, 'require' => true),
                'depotSubId' => array('name' => 'depotSubId', 'type' => 'int', 'min' => 0, 'require' => true),
            ),
            'ALLOT_IN'    => array(
                'supplierId' => array('name' => 'supplierId', 'type' => 'int', 'min' => 0, 'require' => true),
                'depotSubId' => array('name' => 'depotSubId', 'type' => 'int', 'min' => 0, 'require' => true),
            ),
            'ALLOT_OUT'   => array(
                'id'           => array('name' => 'id', 'type' => 'int', 'min' => 0, 'require' => true),
                'departmentId' => array('name' => 'departmentId', 'type' => 'int', 'min' => 0, 'require' => true),
                'employeeId'   => array('name' => 'employeeId', 'type' => 'int', 'min' => 0, 'require' => true),
            ),
            'USE_OUT'     => array(
                'id'           => array('name' => 'id', 'type' => 'int', 'min' => 0, 'require' => true),
                'departmentId' => array('name' => 'departmentId', 'type' => 'int', 'min' => 0, 'require' => true),
                'employeeId'   => array('name' => 'employeeId', 'type' => 'int', 'min' => 0, 'require' => true),
            ),
            'INVENTORY'   => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 0, 'require' => true),
            ),
            'SALE_OUT'=>array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );

        if ($type == 'ALLOT_OUT' || $type == 'USE_OUT' || $type == 'INVENTORY' ) {
            unset($common_rules['goodsPrice']);
            unset($common_rules['goodsId']);
        }
        if($type=='SALE_OUT'){
            unset($common_rules['goodsId']);
        }


        $rules = array_key_exists($type, $type_rules) ? array_merge($common_rules, $type_rules[$type]) : $common_rules;


        $this->rules = $rules;
        $this->type  = $type;

        return array('go' => $this->rules);
    }

    public function go()
    {
        $rs = array('code' => 0, 'id' => '', 'msg' => '');

        $domain = new Domain_Order_Goods();

        $input = array();
        foreach ($this->rules as $name => $value) {
            $domain->$name = $this->$name;
            $input[$name]  = $this->$name;
        }

        $domain->type = $this->type;

        $id = $domain->insert($input);
        if ($id === false) {
            $rs['msg'] = '保存失败';
            return $rs;
        }
        $rs['code'] = 1;
        $rs['id']   = $id;
        return $rs;
    }

}
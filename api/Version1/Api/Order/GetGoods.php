<?php

class Api_Order_GetGoods extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'type'    => array(
                    'name'    => 'type',
                    'type'    => 'enum',
                    'range'   => array(
                        'PLAN',
                        'ARRIVAL',
                        'RETURN',
                        'PURCHASE_IN',
                        'ALLOT_IN',
                        'ALLOT_OUT',
                        'USE_OUT',
                        'INVENTORY',
                        'SALE_OUT'
                    ),
                    'require' => true
                ),
                'orderId' => array('name' => 'orderId', 'type' => 'int', 'min' => 1, 'require' => true),
                'id'      => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Order_Goods();

        $domain->type = $this->type;

        $goods = $domain->get($this->orderId, $this->id);
        if ($goods) {
            $rs['code']    = 1;
            $rs['content'] = $goods[0];
            return $rs;
        }
        $rs['msg'] = '订单商品不存在';
        return $rs;
    }
}
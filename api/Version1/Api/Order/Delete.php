<?php

class Api_Order_Delete extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'orderId' => array('name' => 'orderId', 'type' => 'array', 'format' => 'explode', 'require' => true),
                'type' => array('name' => 'type', 'type' => 'enum',
                    'range' => array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY','SALE_OUT'),
                    'require' => true
                ),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Order_Delete($this->type);
        $num = $domain->del($this->orderId);
        if ($num) {
            $rs['code'] = 1;
            $rs['content'] = $num;
            return $rs;
        }

        return $rs;
    }
}
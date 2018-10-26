<?php

class Api_Order_Get extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('PLAN', 'ARRIVAL', 'RETURN', 'PURCHASE_IN', 'ALLOT_IN', 'ALLOT_OUT', 'USE_OUT', 'INVENTORY', 'OTHER_IN', 'OTHER_OUT','SALE_OUT'), 'require' => true),
                'orderId' => array('name' => 'orderId', 'type' => 'int', 'min' => 1, 'require' => true),
                'page_no' => array('name' => 'page_no', 'type' => 'int', 'min' => 0, 'require' => true),
                'page_size' => array('name' => 'page_size', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );
    }

    public function go()
    {
        $rs = array('code' => 0, 'content' => '', 'msg' => '');

        $domain = new Domain_Order_Get($this->type);
        $order = $domain->get($this->orderId, $this->page_no, $this->page_size);
        if (!$order) {
            $rs['msg'] = '订单不存在';
            return false;
        }
        $rs['code'] = 1;
        $rs['content'] = $order;

        return $rs;
    }
}